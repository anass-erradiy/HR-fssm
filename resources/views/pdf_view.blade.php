<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de conge</title>
</head>

<body>
        <style>
            .container-fluid{
                padding-right: 2cm ;
                padding-left: 2cm ;
            }
            .text-center{
                text-align : center ;
                width: 100% ;
                justify-content: center ;

            }
            #logo_FSS{
            align-self: center ;
            height:130px ;
            width: 340px ;
            }
            #lieu{
                text-align: right ;
                padding-right: 50px ;
                font-size: 21px;
                text-decoration: underline  ;
            }
            .separateur{
                color: rgb(116, 81, 81);
            }
            #titre{
                font-size: x-large;
                padding-left: 20px ;
            }
            .container{



            }
            .information-utilisateur{

                display:inline;
                width: 40% ;
                float: left;

            }
            .detail-demande{
                padding-top: 20px ;
                width: 50% ;
                float: right ;
                line-height: 22px


            }
            .autorisation{
                clear: both;

            }
            #footer{
                /* padding-top: 200px ; */
                position: fixed;
                bottom: -40px;
                left: 0px;
                right: 0px;
                /* height: 50px; */
                font-size: 18px !important;

                /** Extra personal styles **/
                /* background-color: #00caca86; */
                /* color: white; */
                text-align: center;
                line-height: 30px;
            }
        </style>
    <div class="container-fluid">

        <div class="text-center">
            <img class="img-fluid" id="logo_FSS" src="{{public_path('assets/img/logo-FSS-marrakech.png')}}" alt="">
        </div>
            <div  id="lieu">
              <div class="col-4">
                <h6>Marrakech le {{ date('Y-m-d') }}</h6>
              </div>
            </div>
            <div id="titre">
              <div class="col-4">
                <h4>Demande d'un ordre de mission </h4>
              </div>
            </div>
            <div class="text-center">
              <div class="col-4">
                <h4>SOM : {{$data->som}} </h4>
              </div>
            </div>
            <div class="container">
                <div class="information-utilisateur">
                    <p> <strong>Prenom</strong> : {{$data->prenom}}</p>
                    <p> <strong>Nom</strong> : {{$data->nom}}</p>
                    <p> <strong>Grade</strong> : @if ($data->admin == 0)
                        C
                        @elseif ($data->admin == 1)
                        B
                        @else
                        A
                        @endif
                    </p>
                    <p> <strong>Adresse Personnel</strong> : {{$data->adress}} </p>
                    <p> <strong>Affectation</strong> :
                        @if ($data->departement == 'MATH')
                        Mathématiques
                        @elseif($data->departement == 'CHIMIE')
                        Chémie
                        @elseif($data->departement == 'GEO')
                        Géologie
                        @elseif($data->departement == 'INFO')
                        Informatique
                        @elseif($data->departement == 'PHYS')
                        Physique
                        @elseif($data->departement == 'BIO')
                        Biologie
                        @else
                        Humanitiés
                        @endif</p>
                </div>
                <div class="detail-demande">
                    <p>J'ai l'honeur de soliciter un(e) : <strong>Demande de congé</strong><br> Du : {{$demmande->date_D}} , Au : {{$demmande->date_F}} <br><br> <strong>Motifs </strong>: {{$demmande->description}} </p>
                </div>
            </div>
            <div class="autorisation">
                <p>Et demander l'autorisation de quitter la tertoire national pour la periode precitee <br> Avis du chef d'Etablissement . <br>A Marrakech, le {{ date('Y-m-d') }}  </p>
                <p><strong>Cachet et Signature</strong> : </p>
            </div>
            <div class="detail-demande">
                <div class="col-4">
                    <p>A Marrakech, le {{ date('Y-m-d') }} <br>Avis de chef du Departement ou le chef du service</p>
                </div>
            </div>
            <div class="text-center" id="footer">
                <span class="separateur">________________________________________________________________</span>
                <br>
                <p class="footer">Boulverard Prince Moulay Bdellah, PB : 2390 -4000 Marrakech <br>Telephone : 0524434649 Telecopie : 0524436769 <br>http// :www.Fssm.ucam.ac.ma</p>
            </div>

    </div>
</body>
</html>
