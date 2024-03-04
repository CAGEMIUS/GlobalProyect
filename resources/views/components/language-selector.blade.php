<style>
/* public/css/custom.css */
.language-selector {
    position: fixed;
    bottom: 20px; /* Ajusta la distancia desde el borde inferior */
    right: 20px; /* Ajusta la distancia desde el borde derecho */
    z-index: 1000; /* Asegura que esté por encima de otros elementos */
}

/* Aplica estilos específicos al select */
.language-selector select {
    font-size: 20px; /* Tamaño de fuente más grande */
    padding: 10px; /* Ajusta el relleno */
    width: 200px; /* Ajusta el ancho */
}

/* Hase que el componente sea más visible */
.language-selector select {
    background-color: #ffffff; /* Color de fondo */
    color: #000000; /* Color del texto */
    border: 2px solid #000000; /* Borde */
    border-radius: 5px; /* Borde redondeado */
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombra */
}
</style>

<div class="language-selector">
    <select name="lang" id="lang" onchange="window.location.href=this.value">
        <option value="{{ route('lang', 'es')}}" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>{{ __('Spanish') }}</option>
        <option value="{{ route('lang', 'en')}}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ __('English') }}</option>
        <option value="{{ route('lang', 'uk')}}" {{ app()->getLocale() == 'uk' ? 'selected' : '' }}>{{ __('Ukraine') }}</option>
        <option value="{{ route('lang', 'fr')}}" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>{{ __('French') }}</option>
    </select>
</div>
