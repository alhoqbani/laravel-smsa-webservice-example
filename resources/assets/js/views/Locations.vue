<template>
    <div>
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <GmapMap
                            ref="mapRef"
                            :center="{lat:24.679549, lng:46.688427}"
                            :zoom="12"
                            map-type-id="terrain"
                            style="width: 100%; height: 500px">
                        <GmapCluster :zoomOnClick="true">
                            <GmapMarker
                                    :key="index"
                                    v-for="(marker, index) in markers"
                                    :position="marker.position"
                                    :clickable="true"
                                    @click="onMarkClick(marker)"
                            />
                        </GmapCluster>
                    </GmapMap>
                </div>

                <div class="col-md-4">
                    <div class="card" style="width: 20rem;" v-if="showSelectedRetail">
                        <div class="card-body">
                            <h4 class="card-title">Retail Code: {{selectedRetail.code}}</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item h4">{{selectedRetail.city}} - {{selectedRetail.route_code}}</li>
                            <li class="list-group-item">{{selectedRetail.address_ar}}</li>
                            <li class="list-group-item">{{selectedRetail.address_en}}</li>
                            <li class="list-group-item">{{selectedRetail.phone}}</li>
                        </ul>
                        <div class="card-body">
                            <a class="card-link" target="_blank"
                               :href="'https://www.google.com/maps/search/?api=1&query=' + selectedRetail.gps_point.trim()">Google
                                Maps</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Locations',

        data() {
            return {
                cities: window.smsaCities,
                retails: window.smsaRetails,
                selectedRetail: {},
                showSelectedRetail: false,
                markers: [],
                center: {
                    lat: 24.679549,
                    lng: 46.688427
                }
            }
        },

        created() {

            // Process retails to get gps points
            this.retails.forEach(retail => {
                let points = retail.gps_point.split(", ").map(point => parseFloat(point.trim(',')));
                this.markers.push({
                    position: {
                        lat: points[0],
                        lng: points[1],
                    },
                    ...retail
                })
            });
        },

        mounted() {
            // At this point, the child GmapMap has been mounted, but
            // its map has not been initialized.
            // Therefore we need to write mapRef.$mapPromise.then(() => ...)

            this.$refs.mapRef.$mapPromise.then((map) => {
                map.panTo(this.center)
            })
        },

        watch: {
            center(newValue) {

                this.$refs.mapRef.$mapPromise.then((map) => {
                    map.panTo(newValue)
                })

            }
        },

        methods: {
            onMarkClick(marker) {
                console.log(marker);
                this.selectedRetail = marker;
                this.showSelectedRetail = true;
                this.center = marker.position
            }
        }

    }

</script>