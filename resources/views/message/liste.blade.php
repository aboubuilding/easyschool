


@extends('layout')

@section('title')

    EASY_PILOT  | Postes

@endsection

@section('css')


@endsection

@section('contenu')

<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Postes  </h4>
                <h6>Listes des postes   </h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="#" id="exportPdf" data-bs-toggle="tooltip" data-bs-placement="top" title="Exporter en Pdf"><img src="{{asset('app')}}/assets/img/icons/pdf.svg" alt="PDF"></a>
            </li>
            <li>
                <a href="#" id="exportExcel" data-bs-toggle="tooltip" data-bs-placement="top" title="Exporter en Excel"><img src="{{asset('app')}}/assets/img/icons/excel.svg" alt="Excel"></a>
            </li>

        </ul>

        <div class="page-btn">
            <a href="#" class="btn btn-primary text-white" id="lancerPoste"><i class="ti ti-circle-plus me-1"></i>Ajouter un poste </a>
        </div>
        <div class="page-btn">


        </div>
    </div>
    <!-- /product list -->



    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                </div>
            </div>
            <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">


            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable" id="listeEleves">
                    <thead class="thead-light">
                    <tr>
                        <th class="no-sort" style="width: 5%">
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th style="width: 70%">Libelle </th>
                        <th style="width: 15%">Nb employes   </th>




                        <th class="no-sort" style="width: 10%"> Actions </th>
                    </tr>
                    </thead>
                    <tbody >

                    @foreach( $postes as $poste )
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">

                                {{  $poste['libelle'] }}
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">

                                {{  $poste['nombre_employes'] }}
                            </div>
                        </td>





                        <td class="text-center">

                        	<div class="action-icon d-inline-flex align-items-center">


                                 <a href="#" class="p-2 d-flex align-items-center border rounded me-2 modifierPoste" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier" data-id="{{$poste['id'] }}"><i class="ti ti-edit"></i></a>
				<a href="javascript:void(0);" class="p-2 d-flex align-items-center border rounded supprimerPoste" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer" data-id="{{$poste['id'] }}"><i class="ti ti-trash"></i></a>

                                </div>




                        </td>
                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /product list -->
</div>


@include('poste.modal')

@endsection


@section('js')

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr (version compatible) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="{{asset('pages/poste.js')}}"></script>

@endsection
