// main.js または適切なエントリポイントファイル
import { drag, allowDrop, drop } from './drawflow-diagram-base.js';

document.addEventListener('DOMContentLoaded', function () {
    const draggableElements = document.querySelectorAll('[draggable="true"]');
    draggableElements.forEach(el => {
        el.addEventListener('dragstart', drag);
    });

    const dropZones = document.querySelectorAll('.drop-zone');
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', allowDrop);
        zone.addEventListener('drop', drop);
    });
});