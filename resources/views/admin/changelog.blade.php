@extends('layouts.admin')

@section('content')

<!-- 
# actionBody in PDF änderbar
# Email-Resend-Buttons 
# Geschlecht
-->

<section class="row" id="content">

  	  <div class="large-12 column">
  	  	<h1><i class="fa fa-newspaper-o"></i> Changelog</h1>
        <div class="callout">
          <h4>17.03.2016 - Custom Emails Update</h4>
          <ul>
            <li>Hat ein User nur seine Emailadresse registriert, wird diese anstelle des Namens im Adminbereich angezeigt.</li>
            <li>Geschlecht der User wird in den Usertabellen angezeigt</li>
            <li>PDFs können im Adminbereich manuell erstellt werden</li>
            <li>Bestätigungsemails können im Adminbereich manuell erstellt werden</li>
            <li>Manuell erstellte PDFs können den Bestätigungsemails zugeordnet werden</li>
            <li>Manuell erstellte Bestätigungsemails können den Aktionen zugeordnet werden</li>
            <li>Sollten einer Aktion keine Bestätigungsemails zugeordnet worden sein, wird auf Standard-Emails zurückgegriffen</li>
            <li>Sollten einer Bestätigungsemail keine PDFs zugeordnet worden sein, wird auf Standard-PDFs zurückgegriffen</li>
          </ul>
        </div>
        <div class="callout">
          <h4>14.03.2016</h4>
          <ul>
            <li>Bei der manuellen Bestätigung von Benutzern werden ebenfalls Gewinncodes vergeben, die zuvor mit dem Kommentar "MMM" angelegt wurden.</li>
          </ul>
        </div>
  	  	<div class="callout">
  	  		<h4>13.03.2016</h4>
  	  		<ul>
  	  			<li>Gewinncodes können nicht mehr verwendet werden, wenn die Ablaufzeit überschritten wurde</li>
  	  			<li>Das Standard-Ablaufdatum für Gewinncodes ist gleich dem Enddatum der zugehörigen Aktion</li>
  	  			<li>Gewinncodes können auch noch eingegeben werden, nachdem man bereits an einer Aktion teilnimmt</li>
  	  			<li>Neue Option für Aktionen: Alle Teilnehmer gewinnen automatisch</li>
  	  			<li>Gewinncodes sind immer genau zehn Zeichen lang</li>
  	  			<li>Emails werden über die PHP-Mail Funktion verschickt</li>
  	  		</ul>
  	  	</div>
  	  </div>

</section>

@endsection