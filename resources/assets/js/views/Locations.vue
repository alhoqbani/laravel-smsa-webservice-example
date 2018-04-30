<template>
    <div>
        <div class="container">

            <div class="row">
                <div class="input-group mb-3 col-md-4">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="city-filter">City</label>
                    </div>
                    <select class="custom-select" id="city-filter" @change="filterByCity()" v-model="cityFilter">
                        <option value="" selected>All Cities</option>
                        <option v-for="city of cities" :value="city">{{city}}</option>
                    </select>
                </div>

                <div class="input-group mb-3 col-md-4">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="route-filter">Route</label>
                    </div>
                    <select class="custom-select" id="route-filter" @change="filterByRoute()" v-model="routeFilter">
                        <option value="" selected>All Routes</option>
                        <option v-for="route of routes" :value="route">{{route}}</option>
                    </select>
                </div>
            </div>

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
                                    v-for="(marker, index) in filteredMarkers"
                                    :position="marker.position"
                                    :clickable="true"
                                    @click="onMarkClick(marker)"/>
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
    import {gmapApi} from 'vue2-google-maps';

    export default {
        name: 'Locations',

        data() {
            return {
                cities: [],
                cityFilter: '',
                routes: [],
                routeFilter: '',
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

        computed: {
            google: gmapApi,

            filteredMarkers() {
                let filteredMarkers = this.cityFilter ?
                    this.markers.filter(marker => marker.city === this.cityFilter) :
                    this.markers;

                if (this.routeFilter) {
                   filteredMarkers = this.markers.filter(marker => marker.route_code === this.routeFilter)
                }

                if (this.google !== null) {
                    let bounds = new this.google.maps.LatLngBounds();
                    filteredMarkers.forEach(mark => {
                        bounds.extend(mark.position);
                    });
                    this.$refs.mapRef.fitBounds(bounds);
                }

                return filteredMarkers;
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
                });

                // Collect unique cities
                if (this.cities.indexOf(retail.city) === -1) {
                    this.cities.push(retail.city)
                }
                this.cities.sort();

                if (this.routes.indexOf(retail.route_code) === -1) {
                    this.routes.push(retail.route_code)
                }
                this.routes.sort();

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
            },

            filterByCity() {
                this.routeFilter = '';
            },

            filterByRoute() {
                this.cityFilter = '';
            }
        },


    }

</script>