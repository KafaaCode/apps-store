@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
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
@endpush

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
                                <th>@lang('translation.slug')</th>
                                <th>@lang('translation.title')</th>
                                <th>@lang('translation.keywords')</th>
                                <th>@lang('translation.name_currency')</th>
                                <th>@lang('translation.need_name_player')</th>
                                <th>@lang('translation.need_id_player')</th>
                                <th>@lang('translation.price_qty')</th>
                                <th>@lang('translation.is_active')</th>
                                <th>@lang('translation.is_show')</th>
                                <th>@lang('translation.have_packages')</th>
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
                                    <td>{{ $game->slug }}</td>
                                    <td>{{ $game->title }}</td>
                                    <td>{{ $game->keywords }}</td>
                                    <td>{{ $game->name_currency }}</td>
                                    <td>{{ $game->name_player_string }}</td>
                                    <td>{{ $game->id_player_string }}</td>
                                    <td>{{ number_format($game->price_qty, 2) }}</td>
                                    <td>{{ $game->active_string }}</td>
                                    <td>{{ $game->is_show_string }}</td>
                                    <td>{{ $game->have_packages_string }}</td>
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