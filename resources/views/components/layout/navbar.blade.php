@php
    function html($navbar, $ref = null, $index = 0) {
        $html = "";
        if (count($navbar) > 4 && $index == 0) {
            $hasActive = false;
            foreach ($navbar as $key => $item) {
                if ($key > 3 && $item['active']) {
                    $hasActive = true;
                    break;
                }
            }
        }
        foreach ($navbar as $key => $item) {
            if ($key > 3 && $index == 0) {
                $html .= '<li class="menu single-menu menu-extras ' . ($hasActive ? 'active' : '') . '">';
                $html .= '<a href="#more" data-toggle="collapse" class="dropdown-toggle" aria-expanded="' . ($hasActive ? 'true' : 'false') . '">';
                $html .= '<div>';
                $html .= '<span>';
                $html .= '<i data-feather="more-horizontal"></i>';
                $html .= '<span class="d-xl-none">Xem thêm</span>';
                $html .= '</span>';
                $html .= '</div>';
                $html .= '<i data-feather="chevron-down"></i>';
                $html .= '</a>';
                $html .= '<ul class="collapse submenu list-unstyled animated fadeInUp ' . ($hasActive ? 'show' : '') . '" id="more" data-parent="#topAccordion">';
                $html .= html(array_slice($navbar, 4), "more", 1);
                $html .= '</ul>';
                $html .= '</li>';
                break;
            }
            if ($index == 0) {
                $html .= '<li class="menu single-menu ' . ($item['active'] ? 'active' : '') . '">';
                if (count($item["item"]) > 0) {
                    $html .= '<a href="#' . $item['ref'] . '" data-toggle="collapse" class="dropdown-toggle" aria-expanded="' . ($item['active'] ? 'true' : 'false') . '">';
                    $html .= '<div>';
                    $html .= '<i data-feather="' . $item['icon'] . '"></i>';
                    $html .= '<i data-feather="' . $item['icon'] . '" class="shadow-icons"></i>';
                    $html .= '<span>' . $item['title'] . '</span>';
                    $html .= '</div>';
                    $html .= '<i data-feather="chevron-down"></i>';
                    $html .= '</a>';
                    $html .= '<ul class="collapse submenu list-unstyled animated fadeInUp ' . ($item['active'] ? 'show' : '') . '" id="' . $item['ref'] . '" data-parent="#topAccordion">';
                    $html .= html($item['item'], $item['ref'], $index + 1);
                    $html .= '</ul>';
                } else {
                    $html .= '<a href="' . $item['url'] . '">';
                    $html .= '<div>';
                    $html .= '<i data-feather="' . $item['icon'] . '"></i>';
                    $html .= '<i data-feather="' . $item['icon'] . '" class="shadow-icons"></i>';
                    $html .= '<span>' . $item['title'] . '</span>';
                    $html .= '</div>';
                    $html .= '</a>';
                }
                $html .= '</li>';
            } else if ($index > 0 && $index < 3) {
                if (count($item["item"]) > 0) {
                    $html .= '<li class="sub-sub-submenu-list ' . ($item['active'] ? 'active' : '') . '">';
                    $html .= '<a href="#' . $item['ref'] . '" data-toggle="collapse" class="dropdown-toggle" aria-expanded="' . ($item['active'] ? 'true' : 'false') . '">';
                    $html .= $item['title'];
                    $html .= '<i data-feather="chevron-right"></i>';
                    $html .= '</a>';
                    $html .= '<ul class="collapse sub-submenu list-unstyled animated fadeInUp ' . ($item['active'] ? 'show' : '') . '" id="' . $item['ref'] . '" data-parent="#' . $ref . '">';
                    $html .= html($item['item'], $item['ref'], $index + 1);
                    $html .= '</ul>';
                } else {
                    $html .= '<li class="' . ($item['active'] ? 'active' : '') . '">';
                    $html .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a>';
                }
                $html .= '</li>';
            } else {
                $html .= '<li class="' . ($item['active'] ? 'active' : '') . '">';
                $html .= '<a href="' . $item['url'] . '">' . $item['title'] . '</a>';
                $html .= '</li>';
            }
        }
        return $html;
    }

    $html = html($navbar);
@endphp

<ul class="list-unstyled menu-categories" id="topAccordion" style="height: calc(100% - 66px)">{!! $html !!}</ul>