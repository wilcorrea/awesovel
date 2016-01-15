<a href="{{ \Awesovel\Helpers\Url::link($language, $module, $entity, $button, $_colletion) }}" title="{{ $button->title }}" class="btn btn-default {{ $button->className }}">
    @if (isset($button->classIcon) && $button->classIcon)
        <span class="{{ $button->classIcon }}" aria-hidden="true"></span>
    @endif
    {{ $button->label }}
</a>