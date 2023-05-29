@props(['filter', 'selected'])

<ul>
    @foreach($filter as $key=>$category)
        <li class="text-left whitespace-nowrap">
            <input type="hidden" name="filter-checkbox[{{$key}}]" value="0">
            <input type="checkbox" id="filter-cb-{{$category->id}}" name="filter-checkbox[{{$key}}]" value="{{$category->id}}" 
            @checked($selected == null || $selected[$key] != 0)
            >
            <label for="filter-cb-{{$category->id}}">{{$category->Name}}</label>
        </li>
    @endforeach
</ul>