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
    import CancelShipment from '../components/CancelShipment';

    export default {
        name: 'Shipments',
        components: { CreateShipment, CancelShipment },

        data() {
            return {
                activeComponent: 'CreateShipment',
                tabComponents: [
                    {
                        name: 'CreateShipment',
                        title: 'Create Shipment'
                    },
                    {
                        name: 'CancelShipment',
                        title: 'Cancel Shipment'
                    },
                ]
            }
        },

    }

</script>