@extends('layout.base')

@section('stylesheets')
<link rel="stylesheet" href="/css/list-element.css">
<link rel="stylesheet" href="/css/legal-notice.css">
@endsection

@section('header')
    <span class="header_title">
        <h1>Mentions Légales</h1>
    </span>
@endsection

@section('content')
    <span class="information">
        <h2>Identification de l'éditeur :</h2><br>
        <p>BDE Groupe 3, Parc de La Vatine, 1 Rue Guglielmo Marconi, 76130 Mont-Saint-Aignan </p>
        <p>Telephone : 0625340828</p>
    </span><br>
    <span class="information">
        <h2>Prestataire d'hébergement :</h2><br>
        <p>Pour bde-cesi-msa.fr</p>
        <p>2 Rue Kellermann, 59100 Roubaix</p>
        <p>Telephone : 09 72 10 10 07</p>
    </span><br>
    <span class="information">
        <h2>Traitement des données à caractère personnel :</h2><br>
        <p>bde-cesi-msa.fr receuille les données personnelles suivantes : nom, prénom, adresse mail et centre.</p>
        <p>Les données citées ne sont pas utilisées à des fins commerciales ou analytiques.</p>
        <p>Telephone : 09 72 10 10 07</p>
    </span><br>
    <span id="cgv" class="information">
        <h2>Conditions Générales des ventes (CGV) :</h2><br>

        <h3>Clause n° 1 : Objet :</h3>
        <p>Les conditions générales de vente décrites ci-après détaillent les droits et obligations de la société BDE CESI MSA et de son client dans le cadre de la vente des marchandises suivantes : ... (le vendeur doit recenser les marchandises soumises aux CGV).
            Toute prestation accomplie par la société BDE CESI MSA implique donc l'adhésion sans réserve de l'acheteur aux présentes conditions générales de vente.</p>
        <h3>Clause n° 2 : Prix :</h3>
        <p>Les prix des marchandises vendues sont ceux en vigueur au jour de la prise de commande. Ils sont libellés en euros et calculés hors taxes. Par voie de conséquence, ils seront majorés du taux de TVA et des frais de transport applicables au jour de la commande.
            La société BDE CESI MSA s'accorde le droit de modifier ses tarifs à tout moment. Toutefois, elle s'engage à facturer les marchandises commandées aux prix indiqués lors de l'enregistrement de la commande.</p>
        <p>Les données citées ne sont pas utilisées à des fins commerciales ou analytiques.</p>
        <h3>Clause n° 3 : Rabais et ristournes :</h3>
        <p>Les tarifs proposés comprennent les rabais et ristournes que la société BDE CESI MSA serait amenée à octroyer compte tenu de ses résultats ou de la prise en charge par l'acheteur de certaines prestations.</p>
        <h3>Clause n° 3 : Rabais et ristournes :</h3>
        <p>Le règlement des commandes s'effectue :<ul>
            <li>soit par espèce ;</li>
            <li>soit par carte bancaire ;</li>
        </ul></p>
    </span><br>
@endsection
