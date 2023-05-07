.popover {
    position: absolute;
    display: none;
    background-color: white;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.popover::before {
    content: '';
    position: absolute;
    border-style: solid;
    border-width: 5px;
    border-color: transparent;
    z-index: 1000;


}
.popover.top::before {
    bottom: -10px;
    left: calc(50% - 5px);
    border-top-color: #ccc;
}
.popover.bottom::before {
    top: -10px;
    left: calc(50% - 5px);
    border-bottom-color: #ccc;
}

