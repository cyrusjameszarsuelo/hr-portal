<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Structural + auth tests for the local file storage feature.
 *
 * Spec: .kiro/specs/local-file-storage (Task 9.7)
 *
 * 1. Structural check (Requirement 7.1): none of the nine rewired controllers may
 *    still call cloudinary() in their upload/update code paths. This is verified by
 *    reading each controller source and asserting it does not contain "cloudinary(".
 *
 * 2. Auth check (Requirement 8.3): affected upload routes live inside the
 *    MsGraphAuthenticated middleware group in routes/web.php. An unauthenticated GET
 *    to such a route must NOT return a 200 exposing protected content (it should
 *    redirect or return 401/403). As a resilient fallback, we also assert the route
 *    is registered with the MsGraphAuthenticated middleware via the Route facade.
 */
class LocalFileStorageStructuralTest extends TestCase
{
    /**
     * The nine controllers rewired by this feature. Their upload/update code paths
     * must no longer reference cloudinary().
     */
    private const CONTROLLERS = [
        'CommunityController',
        'BlogController',
        'MeganewsController',
        'MegaTriviaController',
        'MegagramController',
        'MegaGoodVibesController',
        'PhotoGalleryController',
        'CorporateOfficeController',
        'HumanResourceController',
    ];

    private function controllerPath(string $name): string
    {
        return base_path('app/Http/Controllers/' . $name . '.php');
    }

    // -----------------------------------------------------------------------------------
    // Structural check (Requirement 7.1)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Structural: no cloudinary() remains in rewired controllers
    public function test_no_cloudinary_call_remains_in_rewired_controllers(): void
    {
        foreach (self::CONTROLLERS as $controller) {
            $path = $this->controllerPath($controller);

            $this->assertFileExists($path, "Controller source must exist: {$controller}.php");

            $source = file_get_contents($path);

            $this->assertNotFalse($source, "Unable to read controller source: {$controller}.php");

            $this->assertStringNotContainsString(
                'cloudinary(',
                $source,
                "{$controller} must not call cloudinary() in its upload code paths (Requirement 7.1)."
            );
        }
    }

    // -----------------------------------------------------------------------------------
    // Auth check (Requirement 8.3)
    // -----------------------------------------------------------------------------------

    // Feature: local-file-storage, Auth: unauthenticated request to a protected upload route is not a 200
    public function test_unauthenticated_request_to_protected_route_does_not_expose_content(): void
    {
        $response = $this->get('/photo-gallery');

        $status = $response->getStatusCode();

        // The route sits behind MsGraphAuthenticated. An unauthenticated visitor must not
        // receive a 200 that would expose protected content; the middleware should redirect
        // (3xx) or deny (401/403).
        $this->assertNotSame(
            200,
            $status,
            "Unauthenticated GET /photo-gallery must not return 200 (got {$status}); the "
                . 'MsGraphAuthenticated middleware should redirect or deny (Requirement 8.3).'
        );

        $this->assertTrue(
            $status >= 300 && $status < 500 && $status !== 404,
            "Unauthenticated GET /photo-gallery should redirect (3xx) or deny (401/403); got {$status}."
        );
    }

    // Feature: local-file-storage, Auth: protected upload route is registered with MsGraphAuthenticated middleware
    public function test_protected_route_is_registered_with_msgraph_authenticated_middleware(): void
    {
        $target = null;

        foreach (Route::getRoutes() as $route) {
            if ($route->uri() === 'photo-gallery' && in_array('GET', $route->methods(), true)) {
                $target = $route;
                break;
            }
        }

        $this->assertNotNull($target, 'The GET /photo-gallery route must be registered.');

        $this->assertContains(
            'MsGraphAuthenticated',
            $target->gatherMiddleware(),
            'GET /photo-gallery must enforce the MsGraphAuthenticated middleware (Requirement 8.3).'
        );
    }
}
