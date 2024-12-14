<script id="code">
    function init() {

      const $ = go.GraphObject.make;  // for conciseness in defining templates

      myDiagram =
        $(go.Diagram, "myDiagramDiv", // must be the ID or reference to div
          {
            initialAutoScale: go.Diagram.Uniform,
            maxSelectionCount: 1, // users can select only one part at a time
            layout:
              $(go.TreeLayout,
                {
                  treeStyle: go.TreeLayout.StyleLastParents,
                  arrangement: go.TreeLayout.ArrangementHorizontal,
                  // properties for most of the tree:
                  angle: 90,
                  layerSpacing: 35,
                  // properties for the "last parents":
                  alternateAngle: 90,
                  alternateLayerSpacing: 35,
                  alternateNodeSpacing: 20
                }),
          });



      var levelColors = ["#AC193D", "#2672EC", "#8C0095", "#5133AB",
        "#008299", "#D24726", "#008A00", "#094AB2"];

      // override TreeLayout.commitNodes to also modify the background brush based on the tree depth level
      myDiagram.layout.commitNodes = function() {
        go.TreeLayout.prototype.commitNodes.call(myDiagram.layout);  // do the standard behavior
        myDiagram.layout.network.vertexes.each(v => {
          if (v.node) {
            var level = v.level % (levelColors.length);
            var color = levelColors[level];
            var shape = v.node.findObject("SHAPE");
            if (shape) shape.stroke = $(go.Brush, "Linear", { 0: color, 1: go.Brush.lightenBy(color, 0.05), start: go.Spot.Left, end: go.Spot.Right });
          }
        });
      };


      // This function provides a common style for most of the TextBlocks.
      // Some of these values may be overridden in a particular TextBlock.
      function textStyle() {
        return { font: "9pt  Segoe UI,sans-serif", stroke: "white" };
      }

      // This converter is used by the Picture.
      function findHeadShot(key) {
        if (key < 0 || key > 16) return "samples/images/HSnopic.jpg"; // There are only 16 images on the server
        return "samples/images/HS" + key + ".jpg"
      }

      // define the Node template
      myDiagram.nodeTemplate =
        $(go.Node, "Auto",
          // for sorting, have the Node.text be the data.name
          new go.Binding("text", "name"),
          // bind the Part.layerName to control the Node's layer depending on whether it isSelected
          new go.Binding("layerName", "isSelected", sel => sel ? "Foreground" : "").ofObject(),
          // define the node's outer shape
          $(go.Shape, "Rectangle",
            {
              name: "SHAPE", fill: "#333333", stroke: 'white', strokeWidth: 3.5,
              // set the port properties:
              portId: "", fromLinkable: true, toLinkable: true, cursor: "pointer"
            }),
          $(go.Panel, "Horizontal",
            $(go.Picture,
              {
                name: "Picture",
                desiredSize: new go.Size(70, 70),
                margin: 1.5,
              },
              new go.Binding("source", "key", findHeadShot)),
            // define the panel where the text will appear
            $(go.Panel, "Table",
              {
                minSize: new go.Size(130, NaN),
                maxSize: new go.Size(150, NaN),
                margin: new go.Margin(6, 10, 0, 6),
                defaultAlignment: go.Spot.Left
              },
              $(go.RowColumnDefinition, { column: 2, width: 4 }),
              $(go.TextBlock, textStyle(),  // the name
                {
                  row: 0, column: 0, columnSpan: 5,
                  font: "12pt Segoe UI,sans-serif",
                  editable: false, isMultiline: false,
                  minSize: new go.Size(10, 16)
                },
                new go.Binding("text", "name").makeTwoWay()),
              $(go.TextBlock, "Title: ", textStyle(),
                { row: 1, column: 0 }),
              $(go.TextBlock, textStyle(),
                {
                  row: 1, column: 1, columnSpan: 4,
                  editable: false, isMultiline: false,
                  minSize: new go.Size(10, 14),
                  margin: new go.Margin(0, 0, 0, 3)
                },
                new go.Binding("text", "title").makeTwoWay()),
              // $(go.TextBlock, textStyle(),
              //   { row: 2, column: 0 },
              //   new go.Binding("text", "key", v => "ID: " + v)),
              // $(go.TextBlock, textStyle(),
              //   { name: "boss", row: 2, column: 3, }, // we include a name so we can access this TextBlock when deleting Nodes/Links
              //   new go.Binding("text", "parent", v => "Boss: " + v)),
              $(go.TextBlock, textStyle(),  // the comments
                {
                  row: 3, column: 0, columnSpan: 5,
                  font: "italic 9pt sans-serif",
                  wrap: go.TextBlock.WrapFit,
                  editable: false,  // by default newlines are allowed
                  minSize: new go.Size(10, 14)
                },
                new go.Binding("text", "comments").makeTwoWay())
            )  // end Table Panel
          ) // end Horizontal Panel
        );  // end Node

      

      // define the Link template
      myDiagram.linkTemplate =
        $(go.Link, go.Link.Orthogonal,
          { corner: 5, relinkableFrom: true, relinkableTo: true },
          $(go.Shape, { strokeWidth: 1.5, stroke: "#F5F5F5" }));  // the link shape

      // read in the JSON-format data from the "mySavedModel" element
      load();

      // Setup zoom to fit button
      document.getElementById('zoomToFit').addEventListener('click', () => myDiagram.commandHandler.zoomToFit());

      document.getElementById('centerRoot').addEventListener('click', () => {
        myDiagram.scale = 1;
        myDiagram.commandHandler.scrollToPart(myDiagram.findNodeForKey(1));
      });

    } // end init

    // Show the diagram's model in JSON format
    function save() {
      document.getElementById("mySavedModel").value = myDiagram.model.toJson();
      myDiagram.isModified = false;
    }
    function load() {
      myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
      // make sure new data keys are unique positive integers
      var lastkey = 1;
      myDiagram.model.makeUniqueKeyFunction = (model, data) => {
        var k = data.key || lastkey;
        while (model.findNodeDataForKey(k)) k++;
        data.key = lastkey = k;
        return k;
      };
    }
    window.addEventListener('DOMContentLoaded', init);
  </script>


