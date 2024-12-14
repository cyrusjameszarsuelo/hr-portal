@extends('welcome')

@section('title', 'Human Resources')

@section('content')

	<div id="sample">
		<div id="myDiagramDiv" style="background-color: #34343C; border: solid 1px black; height: 500px; width: 50vw"></div>

		<p><button id="zoomToFit" class="btn btn-primary">Zoom to Fit</button> <button id="centerRoot" class="btn btn-secondary">Center on root</button></p>

		<div>
			<div id="myInspector">
			</div>
		</div>

		<div>
			<textarea id="mySavedModel" hidden style="width:100%; height:160px;">
				{ "class": "go.TreeModel",
  "nodeDataArray": [
{"key":1, "name":"Stella Payne Diaz", "title":"CEO"},
{"key":2, "name":"Luke Warm", "title":"VP Marketing/Sales", "parent":1},
{"key":3, "name":"Meg Meehan Hoffa", "title":"Sales", "parent":2},
{"key":4, "name":"Peggy Flaming", "title":"VP Engineering", "parent":1},
{"key":5, "name":"Saul Wellingood", "title":"Manufacturing", "parent":4},
{"key":6, "name":"Al Ligori", "title":"Marketing", "parent":2},
{"key":7, "name":"Dot Stubadd", "title":"Sales Rep", "parent":3},
{"key":8, "name":"Les Ismore", "title":"Project Mgr", "parent":5},
{"key":9, "name":"April Lynn Parris", "title":"Events Mgr", "parent":6},
{"key":10, "name":"Xavier Breath", "title":"Engineering", "parent":4},
{"key":11, "name":"Anita Hammer", "title":"Process", "parent":5},
{"key":12, "name":"Billy Aiken", "title":"Software", "parent":10},
{"key":13, "name":"Stan Wellback", "title":"Testing", "parent":10},
{"key":14, "name":"Marge Innovera", "title":"Hardware", "parent":10},
{"key":15, "name":"Evan Elpus", "title":"Quality", "parent":5},
{"key":16, "name":"Lotta B. Essen", "title":"Sales Rep", "parent":3}
 ]
}
    
					    
		</textarea>
		</div>
	</div>

@endsection

@section('scripts')
    @include('scripts.human_resources')
@endsection