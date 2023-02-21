<script>
    export let event;
    import Layout from "../Shared/Layout.svelte";
    import InfoText from "../Shared/InfoText.svelte";
    import Button from "../Shared/Button.svelte";
    import { page, router } from '@inertiajs/svelte';
    import BookmarkButton from "../Shared/BookmarkButton.svelte";
    import Form from "../Shared/Form.svelte";
    import axios from "axios";
    import H1 from "../Shared/H1.svelte";

    let updating = false;

    function eventUpdated() {
        updating = false;
        router.reload();
    }

    let clickBtn = () => {
        updating = true;
        rData();
    }
    
    function formatDate(dateString) {
        let date = new Date(dateString);
    
        let day = date.getDate().toString().padStart(2, '0');
        let month = (date.getMonth() + 1).toString().padStart(2, '0');
        let year = date.getFullYear();
        let hours = date.getUTCHours().toString().padStart(2, '0');
        let minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + "." + month + "." + year + " - " + hours + ":" + minutes + " Uhr";
    }

    function cancel() {
        eventUpdated();
    }
    let data;
    let rData = () => data = [
        {
            name: "Titel",
            bind: "TITLE",
            type: "text",
            value: event.TITLE,
            errorname: "TITLE",
            error: ""
        },
        {
            name: "Beschreibung",
            bind: "DESCRIPTION",
            type: "text",
            value: event.DESCRIPTION,
            errorname: "DESCRIPTION",
            error: ""
        },
        /* {
            name: "Typ",
            bind: "EVENT_TYPE",
            type: "array",
            options: [
                {
                    name: "Konzert",
                    value: "Konzert"
                },
                {
                    name: "Festival",
                    value: "Festival"
                }
            ],
            value: event.EVENT_TYPE,
            errorname: "EVENT_TYPE",
            error: ""
        }, */
        {
            name: "Startzeit",
            bind: "STARTING_TIME",
            type: "datetime",
            value: event.STARTING_TIME,
            errorname: "STARTING_TIME",
            error: ""
        },
        {
            name: "Endzeit",
            bind: "ENDING_TIME",
            type: "datetime",
            value: event.ENDING_TIME,
            errorname: "ENDING_TIME",
            error: ""
        },
        {
            name: "Postleitzahl",
            bind: "POSTAL_CODE",
            type: "text",
            value: event.POSTAL_CODE,
            errorname: "POSTAL_CODE",
            error: ""
        },
        {
            name: "Stadt",
            bind: "CITY",
            type: "text",
            value: event.CITY,
            errorname: "CITY",
            error: ""
        },
        {
            name: "Adresse",
            bind: "ADDRESS",
            type: "text",
            value: event.ADDRESS,
            errorname: "ADDRESS",
            error: ""
        },
        {
            name: "Bild",
            bind: "IMAGE_PATH",
            type: "text",
            value: event.IMAGE_PATH,
            errorname: "IMAGE_PATH",
            error: ""
        },
        {
            name: "Webseite",
            bind: "WEBSITE_URL",
            type: "text",
            value: event.WEBSITE_URL,
            errorname: "WEBSITE_URL",
            error: ""
        },
        {
            name: "E-Mail",
            bind: "EMAIL",
            type: "text",
            value: event.EMAIL,
            errorname: "EMAIL",
            error: ""
        },
        {
            name: "Telefonnummer",
            bind: "PHONE_NR",
            type: "text",
            value: event.PHONE_NR,
            errorname: "PHONE_NR",
            error: ""
        }
    ];
    rData();

    let deleteEvent = () => {
        if(window.confirm('Möchten Sie das Event wirklich löschen?')) {
            axios.delete('/events/' + event.EVENT_ID);
            router.get('/events');
        }
    }

    /* let javaToMysqlDatetime = (java) => {
        let dateObj = new Date(java);
        //return dateObj.toISOString().replace('Z', '.000000Z');

        let year = dateObj.getFullYear();
        let month = dateObj.getMonth() + 1;
        let day = dateObj.getDate();
        let hour = dateObj.getHours() - 2;
        let minute = dateObj.getMinutes();
        
        return `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}T${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
    } */

    let submit = () => {
        let submitdata = data/* .map(element => {
            if(element.type === "datetime")
                element.value = javaToMysqlDatetime(element.value);
            return element;
        }) */.map(element => {
            return {
                [element["bind"]]: element["value"]
            }
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.put('/events/' + event.EVENT_ID, submitdata)
            .then(response => {
                if (response.status === 200) {
                    eventUpdated();
                }
            })
            .catch(error => {
                if (error?.response?.status === 422) {
                    for (const [key, value] of Object.entries(data)) {
                        if(error.response.data.errors[value["errorname"]]) {
                            data[key]["error"] = error.response.data.errors[value["errorname"]][0];
                        } else {
                            data[key]["error"] = "";
                        }
                    }
                }
            });
    }
</script>

<Layout>
    {#if updating}
        <Form newInstance={false} {data} onSubmit={submit} onCancel={cancel} onDelete={deleteEvent}></Form>
    {:else}
        <div class="tw-grid tw-gap-4 md:tw-grid-cols-2 tw-my-8">
            <div>
                <H1 mt={false}>{event.TITLE}</H1>
                {#if event.facility.NAME}
                    <InfoText color="gray">{event.facility.NAME}</InfoText>
                {:else}
                    <InfoText color="gray">{event.account.NAME}</InfoText>
                {/if}
                <InfoText color="blue">{event.EVENT_TYPE}</InfoText>
                <BookmarkButton checkId={event.EVENT_ID}></BookmarkButton>
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
                <img class="tw-object-cover tw-h-full tw-w-full tw-rounded-xl" src="/images/uploads/{event.IMAGE_PATH}" alt="{event.NAME}">
            </div>
        </div>
        {#if event.ACCOUNT_ID == $page?.props?.auth?.user?.ACCOUNT_ID || event.facility.managers != null && $page.props.auth.user?.ACCOUNT_ID in event?.facility?.managers?.map(account => account.ACCOUNT_ID)}
            <div class="tw-flex tw-justify-end">
                <div on:click={clickBtn}>
                    <Button>Bearbeiten</Button>
                </div>
            </div>
        {/if}
        <h3>Beschreibung</h3>
        <p>{event.DESCRIPTION}</p>
    {/if}
</Layout>