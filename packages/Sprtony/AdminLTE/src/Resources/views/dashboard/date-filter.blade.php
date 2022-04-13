<script type="text/x-template" id="date-filter-template">
    <div class="row">
    <div class="col-lg-6">
        <div class="input-group mb-3">
            <date @onChange="applyFilter('start', $event)" hide-remove-button="1">
                <input type="text" class="form-control" id="start_date"
                    placeholder="{{ __('admin::app.dashboard.from') }}" v-model="start" />
            </date>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar-alt"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="input-group mb-3">
            <date @onChange="applyFilter('end', $event)" hide-remove-button="1">
                <input type="text" class="form-control" id="end_date"
                    placeholder="{{ __('admin::app.dashboard.to') }}" v-model="end" />
            </date>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-calendar-alt"></span>
                </div>
            </div>
        </div>
    </div>

</div>
</script>
