<x-app-layout>
    <x-slot name="pageheader">
        {{ __('Pricebook') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="col-span-1 p-4 bg-gray-100 text-center">
                    <form action="{{ route('pricebook')}}" id="pricebookForm">
                        <x-side-panel title="SEARCH">
                            <x-search :search="$search_placeholder" />
                        </x-side-panel>
                        <x-side-panel title='COOPERATIVES'>
                            <ul class="w-full">
                                <li><x-cooperative-radio-button cooperative="BOOK" date="June 1, 2023" :selected="$cooperative_filter" /></li>
                                <li><x-cooperative-radio-button cooperative="AEPA" date="January 1, 2023" :selected="$cooperative_filter" /></li>
                                <li><x-cooperative-radio-button cooperative="E&I" date="January 1, 2023" :selected="$cooperative_filter" /></li>
                                <li><x-cooperative-radio-button cooperative="OMNIA" date="January 1, 2023" :selected="$cooperative_filter" /></li>
                            </ul>
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
                    @include('references.partials._pricebook-table', ['materials'=>$materials, 'pricebook'=>$pricebook, 'discount'=>$discount])
                </div>
            </div>
        </div>
    </div>

    <script>
        
        $(function() {
                    console.log({{auth()->user()->id}})
            $(document).on("change", "input[name=filter-radio]", function() {
                let coop = this.value;
                $("#pricebookForm").attr("action", "{{route('pricebook')}}/" + coop);
                console.log(this.value);
            });
            $(document).on("change", "#filter-checkbox-select-all", function () {
                $(".checkbox-filter").prop("checked", $(this).prop("checked"));
            });
            $(document).on("click", ".checkbox-filter", function() {
                if(!$(this).prop("checked")) {
                    $("#filter-checkbox-select-all").prop("checked", false);
                }
                if($(".checkbox-filter:checked").length === $(".checkbox-filter").length) {
                    $("#filter-checkbox-select-all").prop("checked", true);
                }
            });
        });
        </script>
</x-app-layout>
