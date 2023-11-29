import Animate from "../Animate.js";

(function animacao_login(){
    // ANIMAÇÃO
    const animacao = new Animate();
    const card = document.querySelector(".sb-card");
    animacao.setAnimationUp(card, 20);
    animacao.setAnimationOpacity(imgLogin);

    window.addEventListener("load", () => {
        animacao.startAnimate(card);
        animacao.startAnimate(imgLogin);
    })
})();
