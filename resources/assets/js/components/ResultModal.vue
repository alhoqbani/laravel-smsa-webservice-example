<template>
    <!-- Modal -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog"
         aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Response Results</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Success:</strong> {{ JSON.stringify(result.success)}} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Data:</strong> {{ result.data}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Error:</strong> {{ JSON.stringify(result.error) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Type:</strong> {{ result.type }} - (The SOAP operation used
                                    with SMSA Api)</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h4>Payload:</h4>
                                <dl class="row">
                                    <template v-for="(value, key) in result.payload">
                                        <dt class="col-sm-2">{{key}}</dt>
                                        <dd class="col-sm-10">{{JSON.stringify(value)}}</dd>
                                    </template>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h4>Request:</h4>
                                <pre>{{ result.request }}</pre>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h4>Response:</h4>
                                <pre>{{ result.response }}</pre>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: [
            'result'
        ]
    }
</script>