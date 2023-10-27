@extends('layouts.main')
@section('title')
Home
@endsection
@section('content')
<style>
    #landing-page{
        background-color: rgba(255, 0, 0, 0.208) ;
    }
    /* .image-landing{
        max-width: 100%;
        max-height: 100%;
    } */



</style>
<div class="container-fluid p-0" id="landing-page" >
    <div class="row">
        <div id="header-carousel" class="carousel slide carousel-fade col-lg-12 col-md-12" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/img/fssm.jpg" height="450px" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3 image-landing"  style="max-width: 1050px;">
                            <h4 class="display-1 mb-md-4 text-primary">FSSM</h4>
                            <h5 class="text-white text-uppercase">La Faculté des Sciences Semlalia de Marrakech (FSSM) est l’un des principaux établissements de l’Université Cadi Ayyad. Elle a été créée en 1978. Depuis, elle a connu une dynamique remarquable en termes de formation, de recherche scientifique et de coopération. Ainsi s'est-elle forgée une place de choix dans le paysage de l’enseignement supérieur national.
                                La FSSM compte six départements : Biologie, Chimie, Géologie, Informatique Mathématiques et Physique. Fort de plus de 400 enseignant - chercheurs, dans ces divers champs disciplinaires, la FSSM a produit durant ses 35 années d’existence plus d’un millier de thèses et plusieurs milliers d’articles et a noué des relations de coopération avec des universités en Afrique, en Asie, en Europe et aux USA, en plus d’une coopération nationale de plus en plus forte et structurée avec les divers instituts, écoles et facultés et avec plusieurs organismes et secteurs socio - économiques.</h5>
                        </div>
                    </div>
                </div>
                @foreach($data as $key => $annonce)
                    <div class="carousel-item">
                        <img class="w-100" src="assets/img/{{$key+1}}.jpg" height="450px" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h3 class="display-2 text-warning mb-md-4">{{$annonce->titre_annonce}}</h3>
                                <h5 class="text-white text-uppercase">{{$annonce->body}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
</div>
<!-- Footer Start -->
@endsection
