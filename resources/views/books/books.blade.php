@extends('layouts.userLayout')

@section('content')

    <form id="form" class="flex justify-center" action={{ route("books") }}>
        <div class="w-8/12 bg-white p-6 rounded-lg" >

            <div>
                <div class="flex justify-center mb-4">
                    <x-search :values="$allBooks"></x-search>
                </div>
                <div class="flex">
                    <div class="mr-5 w-2/6">
                        <strong>Filtrovať podľa jazyka</strong>

                        <div class="flex flex-wrap">
                            @foreach ($languages as $language)
                                <div class="w-1/3  flex flex-nowrap">
                                    <input class="self-center" type="checkbox" name="language[]" value="{{ $language->id }}" 
                                    {{ (is_array(old('language'))) && (in_array($language->id ,old('language'))) ? "checked" : ""}}>
                                    <label class="ml-1 self-center" for="{{$language->name}}">{{$language->name}}</label>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="mr-5 w-2/6">
                        <strong>Filtrovať podľa žánra</strong>   
                                     
                        <div class="flex flex-wrap">
                            @foreach ($genres as $genre)
                                <div class="w-1/3 flex flex-nowrap">
                                    <input class="self-center" type="checkbox" name="genre[]" value="{{ $genre->id }}" 
                                    {{ (is_array(old('genre'))) && (in_array($genre->id ,old('genre'))) ? "checked" : ""}}>
                                    <label class="ml-1 self-center" for="{{$genre->name}}">{{$genre->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-row align-middle p-4 border-b border-gray-300">

            </div>
            <div id="mybox" class="p-4 mb-4 w-full flex flex-col divide-y divide-gray-300">
                @if($books->count())

                    @foreach($books as $book)
                        <x-book :book="$book"/> 
                    @endforeach 

                    <div class="flex justify-center">
                        <div class="flex">
                            @foreach ($paginator['pages'] as $page)
                                @if ($page == $paginator['actualPage'])
                                    <input type="radio" id={{ $page }} name="page" value={{ $page }} checked  class="hidden">
                                    <label class="bg-gray-300 w-8 text-center p-1 border-2 border-gray-500 m-1 cursor-pointer rounded" for={{ $page }}>{{ $page }}</label>
                                @else
                                    <input type="radio" id={{ $page }} name="page" value={{ $page }} onclick="submit()" class="hidden">
                                    <label class="bg-gray-100 w-8 text-center p-1 border-2 border-gray-500 m-1 cursor-pointer rounded" for={{ $page }}>{{ $page }}</label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                     
                    @else
                    <p>Nie je žiadna kniha</p>
                @endif
            </div> 
        </div>
    </form>
@endsection