{{--button--}}

@if($action->type === 'frontend')
    <a href="{{ awesovel_link($module, $entity, $action, isset($_collection) ? $_collection : null) }}" title="{{ isset($action->title) ? $action->title : '' }}"
       class="btn btn-raised btn-default {{ $action->className }}">
        @if (isset($action->classIcon) && $action->classIcon)
            <span class="{{ $action->classIcon }}" aria-hidden="true"></span>
        @endif
        {{ isset($action->label) ? $action->label : '' }}
    </a>
@elseif($action->type === 'backend')
    <button type="submit" name="action" value="{{ $action->id }}" form="form" class="btn btn-raised btn-default {{ $action->className }}"
            title="{{ isset($action->title) ? $action->title : '' }}">
        @if (isset($action->classIcon) && $action->classIcon)
            <span class="{{ $action->classIcon }}" aria-hidden="true"></span>
        @endif
            {{ isset($action->label) ? $action->label : '' }}
    </button>
@endif