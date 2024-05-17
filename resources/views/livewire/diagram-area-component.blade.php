<div>
    <div class="card task-diagram">
        <div class="card-header">
            <dvi class="row">
                <div class="card-title d-inline col-3 mt-3">タスク図</div>
                <div class="text-end text-end d-inline col-9" x-data="{}">
                    <div class="btn btn-danger" id="clear">クリア</div>
                    <div class="btn btn-success" @click="save()">保存</div>
                </div>
            </dvi>
        </div>
        {{-- Care about people's approval and you will be their prisoner. --}}
        <div class="card-body" id="diagram" ondrop="drop(event)">

        </div>
    </div>
</div>

@script
<script>
    save = () => {
        let data = window.export_data();
        let url = new URL(window.location.href);

        // URLSearchParamsオブジェクトを取得
        let params = url.searchParams;
        console.log(params);
        // getメソッド
        console.log(params.get('token'));
        let token = params.get('token');
        $wire.save(token, data);
    }
</script>
@endscript