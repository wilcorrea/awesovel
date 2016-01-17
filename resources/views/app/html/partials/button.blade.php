<a href="{{ awesovel_link($module, $entity, $button, $_colletion) }}" title="{{ $button->title }}" class="btn btn-raised btn-default {{ $button->className }}">
    @if (isset($button->classIcon) && $button->classIcon)
        <span class="{{ $button->classIcon }}" aria-hidden="true"></span>
    @endif
    {{ $button->label }}
</a>