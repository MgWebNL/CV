<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Help') ?>
                </h2>
            </div>

            <div class="card-body card-padding">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!-- 1. WAT IS HODI PORTAL -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            1. Wat is <?= HD_APPNAME ?> van <?= HD_COMPANYNAME ?>?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>De <?= HD_APPNAME ?> van <?= HD_COMPANYNAME ?> is een persoonlijke bestelwebsite voor u als klant.</p>
                                        <p>U kunt op deze website door slechts enkele keren te klikken uw meest bestelde artikelen bijbestellen.</p>
                                        <p>Tevens zijn ook al uw orders, offertes en facturen in te zien; zowel de lopende items, als de reeds verwerkte items. Ook zijn uw persoonlijke voorkeuren m.b.t. orderverwerking in te zien en te wijzigen.</p>
                                        <p>Om het nog eenvoudiger te maken voor u, wordt aan de hand van uw verbruik een Ideale voorraad berekend. U krijgt een besteladvies via de mail zodat u met slecht 1 klik uw voorraad altijd up-to-date heeft.</p>
                                        <p>Kortom: <?= HD_APPNAME ?> van <?= HD_COMPANYNAME ?> is de toegevoegde waarde voor u als klant</p>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. OFFERTES -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            2. Dashboard
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        Op uw dashboard ziet u een beknopte weergave van de lopende zaken en actiepunten in uw Portal.<br />
                                        Ook wordt hier uw besteladvies voor artikelen weergegeven.
                                    </div>
                                </div>
                            </div>

                            <!-- 3. ORDERS -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            3. Agenda
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        In de agenda ziet u overzichtelijk wanneer artikelen besteld moeten worden.<br />
                                        Wanneer u op een artikel klikt, krijgt u een uitgebreide weergave van het artikel, de historie en het bestelaantal.

                                    </div>
                                </div>
                            </div>

                            <!-- 4. FACTUREN -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            4. Offertes
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        Hier heeft u een overzicht van al uw offertes. In het menu kunt u een filter toepassen om een specifieke status te bekijken.<br />
                                        U kunt hier ook offertes annuleren, wijzigen en orderen.
                                    </div>
                                </div>
                            </div>

                            <!-- 5. ARTIKELEN -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                            5. Orders
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                    <div class="panel-body">
                                        Hier heeft u een overzicht van al uw orders. In het menu kunt u een filter toepassen om een specifieke status te bekijken.<br />
                                        U kunt hier ook orders opnieuw bestellen en het transport van uw order volgen en getekende vrachtbrieven vinden.
                                    </div>
                                </div>
                            </div>

                            <!-- 6. NIEUWE ARTIKELEN -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSix">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            6. Facturen
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                    <div class="panel-body">
                                        Hier heeft u een overzicht van al uw facturen. In het menu kunt u een filter toepassen om een specifieke status te bekijken.<br />
                                        Ook ziet u per factuur welke order hieraan ten grondslag ligt. Ook kunt u hier via Ideal facturen betalen
                                    </div>
                                </div>
                            </div>

                            <!-- 7. BESTELLEN -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            7. Artikelen
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        In dit overzicht staan alle artikelen die u al eens heeft besteld bij ons, gegroepeerd per productgroep.<br />
                                        Ook wordt hier het besteladvies weergegeven voor deze artikelen.<br />
                                        Artikelen zijn ingedeeld in afnamegroepen: Regulier, incidenteel, historie
                                    </div>
                                </div>
                            </div>

                            <!-- 8. FAVORIETEN -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingEight">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            8. Account
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                    <div class="panel-body">
                                        Hier staan al uw accountgegevens weergegeven.<br />
                                        Ook kunt u hier uw wachtwoord wijzigen, een suggestie sturen en uzelf aan- en afmelden voor onze nieuwsbrieven.

                                    </div>
                                </div>
                            </div>

                            <!-- 1. Wie is -->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingEleven">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                            9. Contact
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                                    <div class="panel-body">
                                        <p><?= HD_COMPANYNAME ?><br />
                                            <?= HD_ADDRESS ?><br />
                                            <?= HD_POSTAL ?> <?= HD_TOWN ?>
                                        <p>Telefoonnummer: <?= HD_TELEPHONE ?></p>
                                        <p>E-mail: <?= HD_EMAIL ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/gpNW5XusLug?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                            <br />&nbsp;
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>