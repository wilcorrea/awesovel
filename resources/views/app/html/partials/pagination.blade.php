<?php

// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($collection->lastPage() > 1)
    <ul class="pagination">
        <li class="{{ ($collection->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $collection->url(1) }}">«</a>
        </li>
        @for ($i = 1; $i <= $collection->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $collection->currentPage() - $half_total_links;
            $to = $collection->currentPage() + $half_total_links;
            if ($collection->currentPage() < $half_total_links) {
                $to += $half_total_links - $collection->currentPage();
            }
            if ($collection->lastPage() - $collection->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($collection->lastPage() - $collection->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($collection->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $collection->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="{{ ($collection->currentPage() == $collection->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $collection->url($collection->lastPage()) }}">»</a>
        </li>
    </ul>
@endif