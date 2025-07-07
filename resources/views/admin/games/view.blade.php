<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#gamesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json"
                },
                "order": [[0, "asc"]],
                "responsive": true
            });
        });
    </script>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body border-bottom">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 card-title flex-grow-1">@lang('translation.Games')</h5>
                    <div class="flex-shrink-0">
                        <a href="{{ url('ad/games/create?action=addGame') }}" class="btn btn-soft-primary">
                            @lang('translation.Add')
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="gamesTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>@lang('translation.id')</th>
                                <th>@lang('translation.icon')</th>
                                <!-- <th>@lang('translation.slug')</th> -->
                                <th>@lang('translation.title')</th>
                                <!-- <th>@lang('translation.keywords')</th> -->
                                <th>@lang('translation.name_currency')</th>
                                <th>@lang('translation.need_name_player')</th>
                                <th>@lang('translation.need_id_player')</th>
                                <th>@lang('translation.price_qty')</th>
                                <th>@lang('translation.is_active')</th>
                                <th>@lang('translation.is_show')</th>
                                <th>@lang('translation.have_packages')</th>
                                <th>API</th>
                                <th>@lang('translation.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach($games as $game)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <th scope="row">
                                        @if($game->image)
                                            <img src="{{ asset('uploads/games/' . $game->image) }}" alt="game image" width="50">
                                        @else
                                            —
                                        @endif
                                    </th>
                                    <!-- <td>{{ $game->slug }}</td> -->
                                    <td>{{ $game->title }}</td>
                                    <!-- <td>{{ $game->keywords }}</td> -->
                                    <td>{{ $game->name_currency }}</td>
                                    <td>{{ $game->name_player_string }}</td>
                                    <td>{{ $game->id_player_string }}</td>
                                    <td>{{ number_format($game->price_qty, 2) }}</td>
                                    <td>{{ $game->active_string }}</td>
                                    <td>{{ $game->is_show_string }}</td>
                                    <td>{{ $game->have_packages_string }}</td>
                                    <td>
                                        <span class="badge rounded-pill px-3 py-2 api-status-badge {{ $game->provider_id ? 'bg-success' : 'bg-danger' }}" style="font-size:1em;cursor:pointer;" data-game-id="{{ $game->id }}" data-provider-id="{{ $game->provider_id }}" data-provider-game-id="{{ $game->provider_game_id }}">
                                            @if($game->provider_id)
                                                {{ optional($game->provider)->name ?? 'مفعل' }}
                                            @else
                                                غير مفعل
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="{{ route('front.game.show', $game->slug) }}"
                                                    class="btn btn-sm btn-soft-primary" title="@lang('translation.view')">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('ad.games.edit', $game->id) }}"
                                                    class="btn btn-sm btn-soft-primary" title="@lang('translation.edit')">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="btn btn-sm btn-soft-danger"
                                                    data-bs-toggle="modal" data-bs-target="#gameDelete_{{ $game->id }}"
                                                    title="@lang('translation.delete')">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                            </li>
                                            @if($game->have_packages == 1)
                                                <li>
                                                    <a href="{{ route('ad.games.packages', $game->id) }}"
                                                        class="btn btn-sm btn-soft-success"
                                                        title="@lang('translation.ViewPackage')">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>

                                <!-- Modal Delete -->
                                <div class="modal fade" id="gameDelete_{{ $game->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">@lang('translation.delete')</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ad.games.destroy', $game->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="modal-body">
                                                    <p>@lang('translation.titleDel') <strong>{{ $game->slug }}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-danger">@lang('translation.delete')</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">@lang('translation.close')</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-4">
                        {!! $games->appends(request()->all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal API Settings -->
<div class="modal fade" id="apiStatusModal" tabindex="-1" aria-labelledby="apiStatusModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apiStatusModalLabel">تعديل حالة API للمنتج</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="apiStatusForm">
          <input type="hidden" id="modalGameId" name="game_id" value="">
          <div class="mb-3">
            <label class="form-label">نوع الربط</label>
            <select class="form-select" id="providerTypeSelect" name="provider_type">
              <option value="manual">يدوي</option>
              <option value="auto">آلي (API)</option>
            </select>
          </div>
          <div id="providerFields" style="display:none;">
            <div class="mb-3">
              <label class="form-label">المزود الحالي</label>
              <input type="text" class="form-control mb-2" id="currentProviderName" value="" readonly style="display:none;">
              <label class="form-label">المزود</label>
              <select class="form-select" id="providerSelect" name="provider_id">
                <option value="">اختر المزود</option>
                @foreach($providers as $provider)
                  <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">منتج المزود الحالي</label>
              <input type="text" class="form-control mb-2" id="currentProviderGameName" value="" readonly style="display:none;">
              <label class="form-label">منتج المزود</label>
              <select class="form-select" id="providerGameSelect" name="provider_game_id">
                <option value="">اختر المنتج</option>
              </select>
            </div>
          </div>
          <div id="apiStatusError" class="alert alert-danger d-none"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        <button type="button" class="btn btn-primary" id="saveApiStatusBtn">حفظ</button>
      </div>
    </div>
  </div>
</div>

@php
    $gamesMapped = $games->keyBy('id')->map(function($g){
        return [
            'provider_id' => $g->provider_id,
            'provider_game_id' => $g->provider_game_id,
            'provider_name' => optional($g->provider)->name,
            'provider_game_name' => $g->provider_game_id ? (optional($g->provider)->name . ' - ' . $g->provider_game_id) : null
        ];
    })->toArray();
@endphp



<script>
$(document).ready(function() {
    var currentGameId = null;
    var providerNames = @json($providers->pluck('name','id'));
    var gamesData = @json($gamesMapped);
    // فتح المودال مع تعبئة البيانات
    $('.api-status-badge').on('click', function() {
        currentGameId = $(this).data('game-id');
        $('#modalGameId').val(currentGameId);
        var game = gamesData[currentGameId];
        var providerId = game ? game.provider_id : '';
        var providerGameId = game ? game.provider_game_id : '';
        var providerName = game ? game.provider_name : '';
        var providerGameName = game ? game.provider_game_name : '';
        if(providerId) {
            $('#providerTypeSelect').val('auto');
            $('#providerFields').show();
            $('#providerSelect').val(providerId);
            fetchProviderGames(providerId, providerGameId);
            $('#currentProviderName').val(providerName).show();
            $('#currentProviderGameName').val(providerGameName).show();
        } else {
            $('#providerTypeSelect').val('manual');
            $('#providerFields').hide();
            $('#providerSelect').val('');
            $('#providerGameSelect').html('<option value="">اختر المنتج</option>');
            $('#currentProviderName').hide();
            $('#currentProviderGameName').hide();
        }
        $('#apiStatusModal').modal('show');
    });
    // إظهار/إخفاء حقول المزود حسب نوع الربط
    $('#providerTypeSelect').on('change', function() {
        if($(this).val() === 'auto') {
            $('#providerFields').show();
            fetchProviderGames($('#providerSelect').val());
        } else {
            $('#providerFields').hide();
        }
    });
    // عند تغيير المزود، جلب المنتجات
    $('#providerSelect').on('change', function() {
        fetchProviderGames($(this).val());
    });
    function fetchProviderGames(providerId, selectedId = '') {
        if(!providerId) {
            $('#providerGameSelect').html('<option value="">اختر المنتج</option>');
            return;
        }
        $('#providerGameSelect').html('<option>جاري التحميل...</option>');
        $.ajax({
            url: '{{ route('ad.games.fetch-products') }}',
            type: 'GET',
            data: { provider: providerId },
            success: function(response) {
                var gameSelect = $('#providerGameSelect');
                gameSelect.empty();
                gameSelect.append('<option value="">اختر المنتج</option>');
                var data = response.data || response;
                if(Array.isArray(data)) {
                    data.forEach(function(item) {
                        if(item && item.id && item.name) {
                            var selected = (item.id == selectedId) ? 'selected' : '';
                            gameSelect.append('<option value="'+item.id+'" '+selected+'>'+item.name+'</option>');
                        }
                    });
                }
            },
            error: function() {
                $('#providerGameSelect').html('<option value="">تعذر جلب المنتجات</option>');
            }
        });
    }
    // حفظ الحالة
    $('#saveApiStatusBtn').on('click', function() {
        var type = $('#providerTypeSelect').val();
        var providerId = $('#providerSelect').val();
        var providerGameId = $('#providerGameSelect').val();
        var data = {};
        if(type === 'auto') {
            if(!providerId || !providerGameId) {
                $('#apiStatusError').removeClass('d-none').text('يجب اختيار المزود والمنتج.');
                return;
            }
            data.provider_id = providerId;
            data.provider_game_id = providerGameId;
        }
        $('#apiStatusError').addClass('d-none');
        $.ajax({
            url: '/ad/games/' + currentGameId + '/toggle-api',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ...data
            },
            success: function(response) {
                if(response.success) {
                    $('#apiStatusModal').modal('hide');
                    var badge = $('.api-status-badge[data-game-id="'+currentGameId+'"]');
                    if(response.status === 'مفعل') {
                        badge.removeClass('bg-danger').addClass('bg-success').text('مفعل');
                    } else {
                        badge.removeClass('bg-success').addClass('bg-danger').text('غير مفعل');
                    }
                } else {
                    $('#apiStatusError').removeClass('d-none').text(response.message || 'حدث خطأ');
                }
            },
            error: function(xhr) {
                let msg = 'حدث خطأ غير متوقع';
                if(xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                $('#apiStatusError').removeClass('d-none').text(msg);
            }
        });
    });
});
</script>
