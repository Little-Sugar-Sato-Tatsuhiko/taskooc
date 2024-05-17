
export function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

export function allowDrop(event) {
    event.preventDefault();
}

export function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    event.target.appendChild(document.getElementById(data));
}
