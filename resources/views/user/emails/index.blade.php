@extends('layouts.user')

@section('content')
    <div class="container mt-4  ">
        <div class="container mt-4">
            <h3 class="text-center text-danger fw-bold">Messaggi:</h3>
            <div class="row justify-content-center">

                {{-- TABLE --}}
                <table class="table table-hover">

                    {{-- HEAD --}}
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="pe-4 text-start">Nome</th>
                            <th scope="col" class="pe-4 text-start">Mail</th>
                            <th scope="col" class="pe-4 text-start">Proprietà</th>
                            <th scope="col" class="text-start">Messaggio</th>
                        </tr>
                    </thead>
                    {{-- / HEAD --}}

                    {{-- BODY --}}
                    <tbody>
                        <tr></tr>

                        @foreach ($estates as $estate)
                            @forelse ($estate->leads as $lead)
                                <tr>
                                    <td class="pe-4">
                                        {{ $lead->name }}
                                    </td>
                                    <td class="pe-4">
                                        {{ $lead->email }}
                                    </td>
                                    <td class="pe-4">
                                        {{ $estate->title }}
                                    </td>
                                    <td>
                                        {{ $lead->message }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th>
                                        NON CI SONO MESSAGGI
                                    </th>
                                </tr>
                            @endforelse
                        @endforeach

                    </tbody>
                    {{-- / BODY --}}

                </table>
                {{-- / TABLE --}}

            </div>
        </div>
    </div>
@endsection
