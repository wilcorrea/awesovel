<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Formly Api-Check -->
<script src="{{ awesovel_asset('formly/api-check.js') }}"></script>

<script src="{{ awesovel_asset('angular/angular.min.js') }}"></script>

<script src="{{ awesovel_asset('formly/formly.js') }}"></script>

<script src="{{ awesovel_asset('@/app/App.js') }}"></script>
<script src="{{ awesovel_asset('@/app/core/Angular.js') }}"></script>

<script src="{{ awesovel_asset('@/app/services/ServiceApi.js') }}"></script>
<script src="{{ awesovel_asset('@/app/services/ServiceDialog.js') }}"></script>

<script src="{{ awesovel_asset('@/app/directives/bootstrap/BootstrapController.js') }}"></script>
<script src="{{ awesovel_asset('@/app/directives/bootstrap/FormlyDirective.js') }}"></script>
{{--<script src="{{ awesovel_asset('@/app/directives/ValidValuesDirective.js') }}"></script>--}}

<script src="{{ url('ng/controller/' . (isset($language) && $language ? $language : 'default')
            . '/'. $module . '/' . $entity . '/' . $form . '/Controller.js') }}"></script>

<script type="text/javascript">
    App.url = '{{ url('') }}';
</script>