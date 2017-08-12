<nav role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand sr-only">Menu</a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ol class="nav navbar-nav">

        	@foreach($nav as $menu)

        		<li class="hvr-underline-from-center"><a href="{{ url( '/'.$menu->category_slug ) }}" class=""> {{ $menu->category_name }} </a></li>

        	@endforeach

                <li class="hvr-underline-from-center"><a href="{{ url( '/labels' ) }}" class=""> Labels </a></li>
                <li class="hvr-underline-from-center"><a href="{{ url( '/graphic-designs' ) }}" class=""> Graphic designs </a></li>

        </ol>
    </div><!-- collapse navbar-collapse -->
</nav>
