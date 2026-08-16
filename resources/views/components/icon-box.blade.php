<div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center shadow-lg shrink-0 transition-all duration-500 group-hover:scale-110 group-hover:shadow-xl group-hover:rotate-3"
     style="background: {{ match($variant ?? 0) {
        0 => 'linear-gradient(135deg, #E8F8F1, #a7f3d0)',
        1 => 'linear-gradient(135deg, #FDF8F0, #fef3c7)',
        2 => 'linear-gradient(135deg, #fef3c7, #fde68a)',
        3 => 'linear-gradient(135deg, #FDF2F0, #fecaca)',
        4 => 'linear-gradient(135deg, #F8F0FF, #e9d5ff)',
        5 => 'linear-gradient(135deg, #F0F8FF, #bae6fd)',
        6 => 'linear-gradient(135deg, #F0FDF4, #bbf7d0)',
        7 => 'linear-gradient(135deg, #FFF7ED, #fed7aa)',
        default => 'linear-gradient(135deg, #E8F8F1, #a7f3d0)'
    } }};">
    {!! $icon !!}
</div>
