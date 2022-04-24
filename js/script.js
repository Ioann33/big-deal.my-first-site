let selects = document.getElementsByTagName('select');
let inputs = document.forms;
let inputSelect = inputs.convert.elements[0];
let firstSelect = selects.first;
let secondSelect = selects.second;

function getElements(){
    return [
        '<option value="1">доллар</option>',
        '<option value="48730">Bitcoin</option>',
        '<option value="3524">Ethereum</option>',
        '<option value="455">BinanceCoin</option>',
        '<option value="1.18">Crdano</option>',
    ];
}

function fillSelect(arrayElements) {
    for (let element of arrayElements){
        firstSelect.innerHTML += element;
        secondSelect.innerHTML += element;
    }
}

function exchange(){
    let firstValue = +firstSelect.value;
    let secondValue = +secondSelect.value;
    let firstNum = inputs.convert.elements[0].value;
    let secondNum = inputs.convert.elements[2].value = (firstValue/secondValue) * firstNum;

}

fillSelect(getElements());

firstSelect.onchange = function () {
    exchange();
}

secondSelect.onchange = function () {
    exchange();
}

inputSelect.onchange = function(){
    exchange();
}