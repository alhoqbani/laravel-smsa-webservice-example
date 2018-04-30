<template>
    <div class="mt-auto">

        <ul class="nav nav-tabs">
            <li class="nav-item" v-for="component in tabComponents">
                <a class="nav-link" href="#"
                   :class="{active: activeComponent === component.name}"
                   @click.prevent="activeComponent = component.name">
                    {{ component.title }}
                </a>
            </li>
        </ul>

        <component :is="activeComponent"></component>

    </div>

</template>

<script>
    import CreateShipment from '../components/CreateShipment';
    import DeleteShipment from '../components/DeleteShipment';

    export default {
        name: 'Shipments',
        components: { CreateShipment, DeleteShipment },

        data() {
            return {
                activeComponent: 'CreateShipment',
                tabComponents: [
                    {
                        name: 'CreateShipment',
                        title: 'Create Shipment'
                    },
                    {
                        name: 'DeleteShipment',
                        title: 'Delete Shipment'
                    },
                ]
            }
        },

    }

</script>