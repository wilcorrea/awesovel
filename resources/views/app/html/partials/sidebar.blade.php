<h5>
    <a href="{{ awesovel_route('app') }}"> Home </a>
</h5>

<ul class="nav nav-stacked">
    <li>
        <a href="{{ awesovel_link('Main', 'Category', 'index') }}">
            <i class="glyphicon glyphicon-flash"></i> Categorias
        </a>
    </li>
    <li>
        <a href="{{ awesovel_link('Register', 'Concourse', 'index') }}">
            <i class="glyphicon glyphicon-link"></i> Concursos
        </a>
    </li>
    <li>
        <a href="{{ awesovel_link('Register', 'ConcourseStatus', 'index') }}">
            <i class="glyphicon glyphicon-link"></i> Status
        </a>
    </li>
    <li>
        <a href=".">
            <i class="glyphicon glyphicon-list-alt"></i> Reports
        </a>
    </li>
    <li>
        <a href=".">
            <i class="glyphicon glyphicon-plus"></i> Advanced.. </a>
    </li>
</ul>