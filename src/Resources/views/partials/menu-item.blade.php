@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
        >
            <i class="fa fa-fw fa-{{ isset($item['icon']) ? $item['icon'] : 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            <span>{{ $item['text'] }}</span>
            @if (isset($item['label']))
                <span class="float-right-container">
                    <span class="label label-{{ isset($item['label_color']) ? $item['label_color'] : 'primary' }} float-right">{{ $item['label'] }}</span>
                </span>
            @elseif (isset($item['submenu']))
                <span class="float-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
            @endif
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('adminlte::partials.menuitems.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
