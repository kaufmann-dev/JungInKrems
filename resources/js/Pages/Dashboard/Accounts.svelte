<script>
    import DashLayout from '../../Shared/DashLayout.svelte';
    import Table from '../../Shared/Table.svelte';
    import Form from '../../Shared/Form.svelte';
    import H1 from '../../Shared/H1.svelte';
    import { router } from '@inertiajs/svelte';

    export let accounts;
    let index = 0;
    let editing = false;
    
    $: data = accounts.map(account =>{
        return {
            ID : account.ACCOUNT_ID,
            Benutzername : account.NAME,
            "E-Mail" : account.EMAIL,
            Rolle: account.ACCOUNT_TYPE,
            Verifiziert: account.IS_EMAIL_VERIFIED ? "Ja" : "Nein",
        }
    });

    $: formData = [{
        name: "Benutzername",
        type: "text",
        value: {...accounts[index]}.NAME,
        bind: "NAME",
        errorname: "NAME",
        error: ""
    },{
        name: "E-Mail",
        type: "text",
        value: {...accounts[index]}.EMAIL,
        bind: "EMAIL",
        errorname: "EMAIL",
        error: ""
    },{
        name: "Rolle",
        type: "array",
        options: [{
            value: "Systemverwalter",
            name: "Systemverwalter"
        },{
            value: "Benutzer",
            name: "Benutzer"
        },{
            value: "Veranstalter",
            name: "Veranstalter"
        }],
        value: {...accounts[index]}.ACCOUNT_TYPE,
        bind: "ACCOUNT_TYPE",
        errorname: "ACCOUNT_TYPE",
        error: ""
    },{
        name: "Verifiziert",
        type: "array",
        options: [{
            value: false,
            name: "Nein"
        },{
            value: true,
            name: "Ja"
        }],
        value: {...accounts[index]}.IS_EMAIL_VERIFIED,
        bind: "IS_EMAIL_VERIFIED",
        errorname: "IS_EMAIL_VERIFIED",
        error: ""
    },{
        name: "Passwort ändern",
        type: "password",
        value: "",
        bind: "PASSWORD",
        errorname: "PASSWORD",
        error: ""
    }];

    function editAccount(event){
        editing = true;
        index = event.detail;
    }

    function deleteAccount(event){
        if(!confirm("Wollen Sie diesen Account wirklich löschen?"))
            return;
        axios.post('/accounts/delete/' + {...accounts[event.detail]}.ACCOUNT_ID);
        editing = false;
        router.reload();
    }

    let submit = () => {
        let submitdata = formData.map(element => {
            if(element["value"] !== "") {
                return {
                    [element["bind"]]: element["value"]
                }
            }
            
        }).reduce((a, b) => Object.assign(a, b), {});

        axios.post('/admin/accounts/' + {...accounts[index]}.ACCOUNT_ID, submitdata)
        .then(response => {
            if (response.status === 200) {
                editing = false;
                router.reload();
            }
        })
        .catch(error => {
            if (error?.response?.status === 422) {
                for (const [key, value] of Object.entries(formData)) {
                    if(error.response.data.errors[value["errorname"]]) {
                        formData[key]["error"] = error.response.data.errors[value["errorname"]][0];
                    } else {
                        formData[key]["error"] = "";
                    }
                }
            }
        });
    }

    let deleteEvent = () => {
        if(!confirm("Wollen Sie diesen Account wirklich löschen?"))
            return;
        axios.post('/accounts/delete/' + {...accounts[index]}.ACCOUNT_ID);
        editing = false;
        router.reload();
    }

    let cancel = () => {
        editing = false;
    }
</script>

<DashLayout>
    <H1>Konten</H1>
    {#if editing}
        <Form newInstance={false} data={formData} onSubmit={submit} onDelete={deleteEvent} onCancel={cancel}></Form>
    {:else}
        <Table on:deleteData={deleteAccount} on:editData={editAccount} {data} ignore={["PASSWORD", "created_at", "updated_at"]}></Table>
    {/if}
</DashLayout>