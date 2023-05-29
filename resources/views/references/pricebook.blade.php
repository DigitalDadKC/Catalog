<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Pricebook') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="col-span-1 p-4 bg-gray-100 text-center">
                    <form method="get" action="{{ route('pricebook') }}">
                        @csrf
                        <x-side-panel title="SEARCH">
                            <x-search :search="$search_placeholder" />
                        </x-side-panel>
                        <x-side-panel title='COOPERATIVES'>
                            <x-filter-radio :filter="$cooperatives" :selected="$coop_filter" />
                        </x-side-panel>
                        <x-side-panel title="CATEGORIES">
                            <x-filter-checkbox :filter="$categories" :selected="$category_filter" />
                        </x-side-panel>
                        <button type="submit" class="float-right p-2.5 font-medium text-white bg-emerald-700 rounded-lg border border-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300">Search</button>
                    </form>
                </div>
                <div class="col-span-3 p-4">
                    <div class="mt-6 p-4">
                        {{$materials->appends(['search' => request()->query('search'), 'filter-radio' => request()->query('filter-radio'), 'filter-checkbox' => request()->query('filter-checkbox')])->links()}}
                    </div>
                    @include('references.partials._pricebook-table', ['materials'=>$materials])
                </div>
            </div>
        </div>
    </div>

    <script>
        
        $(function() {
            // $(document).on("keyup", "#search-dropdown", function() {
            //     let search = $(this).val();
            //     $("#autocomplete-results").fadeIn();
            //     if(search != '') {
            //         let _token = $('meta[name="csrf-token"]').attr('content');
            //         $.ajax({
            //             url: "{{ route('pricebook.fetch') }}",
            //             method: "POST",
            //             data: {search:search, _token:_token},
            //             success: function(data) {
            //                 let output = JSON.parse(data);
            //                 let materialList = '';
            //                 $(output).each(function(key, value) {
            //                     materialList += '<li><a class="dropdown-item autocomplete-result-item" href="#">' + value.SKU + " - " + value.Name + '</a></li>';
            //                 });
            //                 $("#autocomplete-results").html(materialList);
            //             }
            //         });
            //     } else {
            //         $("#autocomplete-results").fadeOut();
            //     }
            // });
            // $(document).on("click", ".autocomplete-result-item", function() {
            //     let search = $(this).text().split(' - ')[0];
            //     $("#search-dropdown").val(search);
            //     $("#autocomplete-results").fadeOut();
            //     let _token = $('meta[name="csrf-token"]').attr('content');
            //     $.ajax({
            //         url: "{{ route('pricebook.fetch') }}",
            //         method: "POST",
            //         data: {search:search, _token:_token},
            //         success: function(data) {
            //             let output = JSON.parse(data);
            //             let price = (output[0].Price) ? "$" + output[0].Price : "QUOTE";
            //             let discount = (output[0].Discountable) ? "Yes" : "No";
            //             let status = (output[0].material_statuses[0]) ? output[0].material_statuses[0].Status : "";
            //             $("#pricebook-table-body").html("<tr>" + 
            //                 "<td>" + output[0].SKU + "</td>" + 
            //                 "<td>" + output[0].Name + "</td>" + 
            //                 "<td>" + output[0].material_unit_sizes[0].Unit_Size + "</td>" + 
            //                 "<td>" + price + "</td>" + 
            //                 "<td>" + status + "</td>" + 
            //                 "<td>" + discount + "</td>" + 
            //                 "<td>" + output[0].material_categories[0].Name + "</td>" + 
            //                 "</tr>");
            //         }
            //     });
            // });
        });
        </script>
</x-app-layout>
