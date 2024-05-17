import Drawflow from 'drawflow';

function addEvent() {
  let elements = document.getElementsByClassName('drag-drawflow');

  for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('touchend', drop, false);
    elements[i].addEventListener('touchmove', positionMobile, false);
    elements[i].addEventListener('touchstart', drag, false);
    elements[i].addEventListener('dragstart', drag, false);
    elements[i].addEventListener('dragend', drop, false);
  }
}

var id = document.getElementById("diagram");
id.addEventListener('ondragover', allowDrop, false);
const editor = new Drawflow(id);
editor.start();

let drag_item = undefined;
// Events!
editor.on('nodeCreated', function (id) {
  console.log("Node created " + id);
})

editor.on('nodeRemoved', function (id) {
  console.log("Node removed " + id);
})

editor.on('nodeSelected', function (id) {
  console.log("Node selected " + id);
})

editor.on('moduleCreated', function (name) {
  console.log("Module Created " + name);
})

editor.on('moduleChanged', function (name) {
  console.log("Module Changed " + name);
})

editor.on('connectionCreated', function (connection) {
  console.log('Connection created');
  console.log(connection);
})

editor.on('connectionRemoved', function (connection) {
  console.log('Connection removed');
  console.log(connection);
})

editor.on('mouseMove', function (position) {
  // console.log('Position mouse x:' + position.x + ' y:' + position.y);
})

editor.on('nodeMoved', function (id) {
  console.log("Node moved " + id);
})

editor.on('zoom', function (zoom) {
  console.log('Zoom level ' + zoom);
})

editor.on('translate', function (position) {
  console.log('Translate x:' + position.x + ' y:' + position.y);
})

editor.on('addReroute', function (id) {
  console.log("Reroute added " + id);
})

editor.on('removeReroute', function (id) {
  console.log("Reroute removed " + id);
})

/* DRAG EVENT */
let diagram_data = document.getElementById('diagram-data').innerText;
let diagram_json_data = {};
try {
  diagram_json_data = JSON.parse(diagram_data);
  editor.import(diagram_json_data);
} catch (error) {

}



/* Mouse and Touch Actions */

addEvent();

var mobile_item_selec = '';
var mobile_last_move = null;

function positionMobile(ev) {
  mobile_last_move = ev;
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  if (ev.type === "touchstart") {
    mobile_item_selec = ev.target.closest(".drag-drawflow").getAttribute('data-node');
  } else {
    ev.dataTransfer.setData("node", ev.target.getAttribute('data-node'));
    drag_item = ev.target.getAttribute('data-node');
  }
}

function drop(ev) {
  if (ev.type === "touchend") {
    var parentdrawflow = document.elementFromPoint(mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY).closest("#drawflow");
    if (parentdrawflow != null) {
      addNodeToDrawFlow(mobile_item_selec, mobile_last_move.touches[0].clientX, mobile_last_move.touches[0].clientY);
    }
    mobile_item_selec = '';
  } else {
    ev.preventDefault();
    var data = drag_item;
    addNodeToDrawFlow(data, ev.clientX, ev.clientY);
  }
}

function addNodeToDrawFlow(json, pos_x, pos_y) {
  if (editor.editor_mode === 'fixed') {
    return false;
  }
  pos_x = pos_x * (editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)) - (editor.precanvas.getBoundingClientRect().x * (editor.precanvas.clientWidth / (editor.precanvas.clientWidth * editor.zoom)));
  pos_y = pos_y * (editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)) - (editor.precanvas.getBoundingClientRect().y * (editor.precanvas.clientHeight / (editor.precanvas.clientHeight * editor.zoom)));
  console.log(json.replace(/\n/, '<br>'));
  let data = JSON.parse(json.replace(/\n/g, '\\n'));

  let html = `
        <div>
            <div class="title-box"> ${data.title}</div>
              <div class="box">
                ${data.description.replace(/\n/g, '<br/>')}
              </div>
            <div class="title-box">
             <span class="member">${data.member}</span><span class="deadline">${data.deadline}</span></div>
        </div>
            `;
  editor.addNode('task', 1, 1, pos_x, pos_y, 'task', {
    name: ''
  }, html);

}

var transform = '';

function showpopup(e) {
  e.target.closest(".drawflow-node").style.zIndex = "9999";
  e.target.children[0].style.display = "block";
  //document.getElementById("modalfix").style.display = "block";

  //e.target.children[0].style.transform = 'translate('+translate.x+'px, '+translate.y+'px)';
  transform = editor.precanvas.style.transform;
  editor.precanvas.style.transform = '';
  editor.precanvas.style.left = editor.canvas_x + 'px';
  editor.precanvas.style.top = editor.canvas_y + 'px';

  //e.target.children[0].style.top  =  -editor.canvas_y - editor.container.offsetTop +'px';
  //e.target.children[0].style.left  =  -editor.canvas_x  - editor.container.offsetLeft +'px';
  editor.editor_mode = "fixed";

}



function changeModule(event) {
  var all = document.querySelectorAll(".menu ul li");
  for (var i = 0; i < all.length; i++) {
    all[i].classList.remove('selected');
  }
  event.target.classList.add('selected');
}

function changeMode(option) {

  if (option == 'lock') {
    lock.style.display = 'none';
    unlock.style.display = 'block';
  } else {
    lock.style.display = 'block';
    unlock.style.display = 'none';
  }

}

document.getElementById('add-task').onclick = () => {
  setTimeout(() => {
    addEvent();
  }, 500);
};

window.export_data = () => {
  let export_data = editor.export();
  console.log(JSON.stringify(export_data));
  return JSON.stringify(export_data);
}

// document.getElementById('export').onclick = () => {
//   let export_data = editor.export();
//   console.log(JSON.stringify(export_data));
//   axios({
//     method: 'post',
//     url: '/user/12345',
//     data: {
//       firstName: 'Fred',
//       lastName: 'Flintstone'
//     }
//   });
// };

document.getElementById('clear').onclick = () => {
  alert();
  editor.clear();
}
