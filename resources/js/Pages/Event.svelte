<script>
    export let event;
    import Layout from "../Shared/Layout.svelte";
    import InfoText from "../Shared/InfoText.svelte";
    import Button from "../Shared/Button.svelte";
    import { page, router } from '@inertiajs/svelte';
    import EventForm from "../Shared/EventForm.svelte";
    import BookmarkButton from "../Shared/BookmarkButton.svelte";
    import axios from "axios";

    let updating = false;

    function eventUpdated() {
        updating = false;
        return router.reload();
    }
    
    function formatDate(dateString) {
        let date = new Date(dateString);
    
        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let year = date.getFullYear();
        let hours = date.getHours().toString().padStart(2, '0');
        let minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + "." + month + "." + year + " - " + hours + ":" + minutes + " Uhr";
    }

    let data = event;


    let errors = Object.assign({}, data);

    Object.keys(errors).forEach(key => {
    errors[key] = '';
    });

    

    let deleteEvent = () => {
        if(window.confirm('Möchten Sie das Event wirklich löschen?')) {
            axios.delete('/events/' + event.EVENT_ID);
            router.get('/events');
        }
    }

    let submit = () => {
      axios.put('/events/' + event.EVENT_ID, data)
      .then(response => {
          if (response.status === 200) {
            eventUpdated();
          }
      })
      .catch(error => {
          if (error?.response?.status === 422) {
            for (const [key, value] of Object.entries(errors)) {
              if(error.response.data.errors[key]) {
                errors[key] = error.response.data.errors[key][0];
              } else {
                errors[key] = '';
              }
            }
          }
      });
    }
</script>

<Layout>
    {#if updating}
        <EventForm newEvent={false} bind:data={data} bind:errors={errors} onSubmit={submit} onDelete={deleteEvent}></EventForm>
    {:else}
        <div class="tw-grid tw-gap-4 md:tw-grid-cols-2 tw-my-8">
            <div>
                <h1 class="tw-text-5xl tw-mb-6">{event.TITLE}</h1>
                <InfoText color="blue">{event.EVENT_TYPE}</InfoText>
                <BookmarkButton checkId={$page.props.auth.user.ACCOUNT_ID}></BookmarkButton>
                <div class="tw-text-xl tw-grid tw-gap-2 tw-mt-4">
                    <div class="tw-flex">
                        <i class="tw-mx-3 tw-text-blue-500 bi bi-geo-alt-fill"></i> <span>{event.ADDRESS}, {event.POSTAL_CODE} {event.CITY}</span>
                    </div>
                    <div class="tw-text-xl tw-grid tw-gap-2 tw-mt-4">
                        <div class="tw-flex">
                            <i class="tw-mx-3 tw-text-blue-500 bi bi-calendar-fill"></i>
                            <div>
                                <InfoText color="light">Start</InfoText><span class="tw-ml-2">
                                {formatDate(event.STARTING_TIME)}</span>
                                {#if event.ENDING_TIME}
                                    <InfoText color="light">Ende</InfoText><span class="tw-ml-2">
                                    {formatDate(event.ENDING_TIME)}</span>
                                {/if}
                            </div>
                        </div>
                    </div>
                    {#if event.PHONE_NR}
                        <div>
                            <i class="tw-mx-3 tw-text-blue-500 bi bi-telephone-fill"></i> <span>{event.PHONE_NR}</span>
                        </div>
                    {/if}
                    {#if event.WEBSITE_URL}
                        <div>
                            <i class="tw-mx-3 tw-text-blue-500 bi bi-link-45deg"></i> <a href="{event.WEBSITE_URL}">{event.WEBSITE_URL}</a>
                        </div>
                    {/if}
                    {#if event.EMAIL}
                        <div>
                            <i class="tw-mx-3 tw-text-blue-500 bi bi-envelope-fill"></i> <span>{event.EMAIL}</span>
                        </div>
                    {/if}
                </div>
            </div>
            <div>
                <img class="tw-object-cover tw-h-full tw-w-full tw-rounded-xl" src="{event.IMAGE_PATH}" alt="{event.NAME}">
            </div>
        </div>
        {#if event.ACCOUNT_ID == $page?.props?.auth?.user?.ACCOUNT_ID}
            <div class="tw-flex tw-justify-end">
                <div on:click={()=>updating=true}>
                    <Button onClick="handleClick">Bearbeiten</Button>
                </div>
            </div>
        {/if}
        <h3>Beschreibung</h3>
        <p>{event.DESCRIPTION}</p>
    {/if}
</Layout>