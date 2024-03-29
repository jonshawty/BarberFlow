(function barbearia_form(){
    const data = new Date();
    const anoAtual = data.getFullYear();
    const mesAtual = data.getMonth();
    const diaAtual = data.getDate();

    // Data
    $('.datepicker').pickadate({
        formatSubmit: 'yyyy/mm/dd',
        hiddenName: true,
        hiddenPrefix: 'prefix__',
        hiddenSuffix: '__suffix',
        language: 'pt-BR',
        min: new Date(anoAtual, mesAtual, diaAtual),
        disable: [
            1 // Desativa todas as segundas-feiras. Remova se não for necessário.
        ],
    })
})();


function handleButton(target){
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.value.length > 0){
        btn.removeAttribute("disabled");
    } 
    else{
        btn.setAttribute("disabled", "disabled");
    }
}

function handleCheck(target){
    const btnAttribute = target.getAttribute("data-target-title");
    const btn = document.querySelector(`#${btnAttribute}`);
    
    if(target.checked){
        btn.removeAttribute("disabled");
    } 
    else{
        const checkeds = document.querySelectorAll("input:checked");
        const InputChecked = Array.from(checkeds);
        InputChecked.length == 0 ? btn.setAttribute("disabled", "disabled"): ""
    }
}


function confirmarServico(){
    const preInfos = [
        {text: "Data:"},
        {text: "Horário:"},
        {text: "Serviço:"}
    ] 

    const posInfos = []
    
    // Inputs
    const dia = document.querySelector("#dia-agendamento").value;
    const horario = document.querySelector("#horario-agendamento").value;
    let servicos = ``;
    // Pegandos os serviços escolhidos
    const checkeds = document.querySelectorAll("input:checked");
    const servicosEscolhidos = Array.from(checkeds);
    servicosEscolhidos.forEach((servico, index) =>{
        servicos += `${servico.value}`;
        const ultimoItem = (servicosEscolhidos.length) - 1;
        ultimoItem != index ? servicos += " | ": ""
    });

    posInfos.push(dia, horario, servicos);

    let confirmarServico = document.querySelector("#confirmar-servico-content");
    confirmarServico.innerHTML = ``;

    const finalInfos = preInfos.map((info, index) => {
        const textContainer = document.createElement("h5");

        textContainer.setAttribute("class", "multisteps-form__title sb-txt-white sb-w-500");
        textContainer.innerHTML = `${info.text} ${posInfos[index]}`;

        return textContainer.outerHTML;
    });

    // Inserindo os valores dinamicamente
    finalInfos.forEach(info => {
        confirmarServico.innerHTML += info;
    })
}

const btnServico = document.querySelector("#btn-servico");
btnServico.addEventListener("click", confirmarServico);