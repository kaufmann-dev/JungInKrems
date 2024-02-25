<script>
    import CenterDiv from '../Shared/CenterDiv.svelte';
    import Button from '../Shared/Button.svelte';
    import H1 from '../Shared/H1.svelte';
    import Subtitle from '../Shared/Subtitle.svelte';
    
    export let status;

    $: title = {
    503: '503: Service nicht verfügbar',
    500: '500: Server Fehler',
    404: '404: Seite nicht gefunden',
    403: '403: Zugriff verweigert',
    401: '401: Nicht autorisiert',
    419: '419: Sitzung abgelaufen',
    413: '413: Anfragekörper zu groß',
  }[status]

  $: description = {
    503: 'Wir arbeiten gerade an der Wiederherstellung des Dienstes.',
    500: 'Es ist ein Fehler aufgetreten.',
    404: 'Die angeforderte Seite konnte nicht gefunden werden.',
    403: 'Sie haben nicht die erforderlichen Rechte um diese Seite aufzurufen.',
    401: 'Sie müssen angemeldet sein um diese Seite aufzurufen.',
    419: 'Ihr Sitzung ist abgelaufen.',
    413: 'Die Größe der übergebenen Daten überschreitet das zulässige Limit für Uploads.', 
  }[status]
</script>

<svelte:head>
    <title>Error</title>
    <meta name="description" content="Error">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
</svelte:head>

<CenterDiv>
  <div class="tw-p-3">
    <H1 mb={false}>{title}</H1>
    <Subtitle>{description}</Subtitle>
    <Button link="/">Zurück zur Startseite</Button>
  </div>
</CenterDiv>