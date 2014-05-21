/*
*/
// Cria o evento Push State
(function (history) {
    "use strict";
    var pushState = history.pushState;
    history.pushState = function (state) {
        if (typeof history.onpushstate === "function") {
            history.onpushstate({state: state});
        }
        // ... whatever else you want to do
        // maybe call onhashchange e.handler
        return pushState.apply(history, arguments);
    };

}) (window.history);


// Objetos Globais
var objMenu = {     
    strUrlPrefix : 'nosfilmes',
    strGet : '?rota=view/',
    ieIndex: 'http://nosfilmes.com.br/'
}

var objEndereco = {
    PaginaAtual: '',
    PaginasAnteriores: ''
}
var contador = 0;

//fim objetos Globais

// Espera os scripts serem carregados
$(document).ready(function($) {
    principaisFuncoes();
});

//Função que é chamada no doc ready e quando carregado via ajax
function principaisFuncoes () {
    startForms();

    $(".submenu").on("click",function(){
        $("#menu").find("ul li").stop().slideToggle();
    });

    $("#subir-topo").on("click",function(){
        $('html, body').stop().animate({
            scrollTop: $("body").offset().top
        }, 1000);
    });

    $(".prevent").on("click",function (e) {
        if ($(this).hasClass('nao-mover')) {

            e.preventDefault();
            var urlFinal = trataURL($(this).attr('href'));  
            mudarEndereco ( urlFinal );    

        } else {

            e.preventDefault();
            var urlFinal = trataURL($(this).attr('href'));  
            mudarEndereco ( urlFinal );

            $('html, body').stop().animate({
                scrollTop: $("#conteudo").offset().top
            }, 1000);    
        }
    });

    // evento Click em qualquer elemento do menu
    $("#menu ul li a").on("click",function (e) {
        e.preventDefault();
        var urlFinal = trataURL($(this).attr('href'));  

        mudarEndereco ( urlFinal );
    });

    if (isTouchDevice()) {
    }
        //CASO FOR TOUCH O QUE FAZER
    else {
        //CASO NÃO FOR TOUCH
    }

    function isTouchDevice(){
      return (typeof(window.ontouchstart) != 'undefined') ? true : false;
    }
}

// Retira todo o lixo da url e retorna o get
function trataURL ( url ) {
    var linkHref = url;                // Recebe o href do menu;
    var hrefPartes = linkHref.split(objMenu.strGet);           // divide o endereço em partes;
    var urlFinal = hrefPartes[hrefPartes.length - 1] ;  // recebe o final do Get tratado para ser passado como URL;
    if(urlFinal.indexOf("&id=") > 0){
        urlFinal = urlFinal.replace("&id=", "-");
    }
    return urlFinal;
}

// função que checa como deve ser feita a mudança de endereço
function mudarEndereco (url) {

    if ($('html').hasClass('ie1') || $('html').hasClass('ie9') || $('html').hasClass('ie8') || $('html').hasClass('ie7') || $('html').hasClass('ie6') ) {

        var urlAtual = new String( trataURL(String(window.location) ) );
        if ( urlAtual.match( /http/gi) ){   // Se o usuário chegou ao site com IE9- e chegou no index
            mudarEnderecoIE ( url );        // comportamento normal de mudança de endereço
        } else {
            window.location( objMenu.ieIndex + url); // Se o usuário não chegou pelo index, redireciona o usuário para o index e substitui o valor da Hash de acordo com o link clicado
        }  
    } else {
        mudarEnderecoHTML5 ( url );
    }
}
// função para trocar o endereço no IE
function mudarEnderecoIE ( url ) {
    $.address.crawlable(true).value(url);
}
// função para trocar o endereço nos browsers compativeis com pushState do html5
function mudarEnderecoHTML5 ( url ) {
    if ( objEndereco.PaginaAtual != url ) {
        objEndereco.PaginaAtual = url;
        window.history.pushState(objEndereco,  "Title", url);
    }    
}
// fim da checagem de endereço

// Unificando os eventos dos browsers :
window.onpopstate = history.onpushstate = function(event) {
    if (event.state != null){
        objEndereco.PaginaAtual = event.state.PaginaAtual;
        navegarParaPagina(event.state.PaginaAtual);
    }
};
$.address.change(function(event) {
    navegarParaPagina ( (event.value).substring(1) );
});
// Fim dos eventos

// Funções de navegação, loading/animações, ajax
function navegarParaPagina (pagina) {
    if (pagina != '') {
        limparAreaUtil(pagina);
    }
}

function limparAreaUtil (pagina) {
    $("#conteudo").html("");
    carregaPagina (pagina);
}


function carregaPagina (pagina) {
    var getPagina = 'main.php?rota=view/' + pagina + '.tpl';

    if (pagina == "/"){
        getPagina = 'main.php?rota=view/home.tpl';
    }


    $.ajax({
        url: getPagina,
        type: "POST",
        beforeSend: function(data){
            $("#carregando").css("display","block !important");
        },
        success: function(data){
            
            $("#carregando").hide();

            setTimeout(function(){
                $("#conteudo").html(data);
    
                principaisFuncoes();
            },500);
        }
    });
}