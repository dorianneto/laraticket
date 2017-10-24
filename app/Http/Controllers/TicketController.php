<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\TicketRoomRequest;
use App\Repositories\TicketRepository;
use Auth;

class TicketController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $ticketRepository;

    /**
     * Undocumented function
     *
     * @param TicketRepository $ticketRepository
     * @param DepartmentRepository $departmentRepository
     * @param PriorityRepository $priorityRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(TicketRepository $ticketRepository)
    {
        parent::__construct();

        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        if (request()->method() == 'POST') {
            $input = request()->except(['_token']);

            array_map(function($value, $key) use (&$input) {
                switch ($key) {
                    case 'department':
                    case 'category':
                    case 'priority':
                        $input[$key . '_id'] = $value;
                        unset($input[$key]);
                        break;
                    default:
                        $input[$key] = $value;
                        break;
                }
            }, $input, array_keys($input));

            $data = $this->ticketRepository->getAllBy($input);

            return view("modules.ticket.index", compact('data'));
        }

        $data = $this->ticketRepository->getAll();

        return view("modules.ticket.index", compact('data'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function archive()
    {
        $data = $this->ticketRepository->getAllArchived();

        return view("modules.ticket.archive", compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archivePost($id)
    {
        try {
            $this->ticketRepository->delete($id);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.ticket.success", ['action' => 'arquivado'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.ticket.error", ['action' => 'arquivar'])
            ];
        }

        return redirect()->route("ticket.index")->with(compact('notice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->ticketRepository->forceDelete($id);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.ticket.success", ['action' => 'excluído'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.ticket.error", ['action' => 'excluir'])
            ];
        }

        return redirect()->route("ticket.archive")->with(compact('notice'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            $this->ticketRepository->restore($id);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.ticket.success", ['action' => 'restaurado'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.ticket.error", ['action' => 'restaurar'])
            ];
        }

        return redirect()->route("ticket.archive")->with(compact('notice'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function report()
    {
        return view('modules.ticket.report');
    }

    /**
     * Undocumented function
     *
     * @param TicketRequest $request
     * @return void
     */
    public function reportPost(TicketRequest $request)
    {
        try {
            $request->merge(['situation' => 'open']);
            $request->merge(['user_id' => Auth::user()->id]);
            $data = $request->except('_token');

            array_map(function($value, $key) use (&$data) {
                switch ($key) {
                    case 'department':
                    case 'category':
                    case 'priority':
                        $data[$key] = false;
                        $data[$key . '_id'] = $value;
                        break;
                    case 'message':
                        $value = false;
                    default:
                        $data[$key] = $value;
                        break;
                }
            }, $data, array_keys($data));

            $data = array_filter($data, function($value) {
                return $value !== false;
            });

            $ticket = $this->ticketRepository->store($data);

            $this->ticketRepository->assign($ticket->id, $request->user_id, ['message' => $request->message]);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.ticket.success", ['action' => 'cadastrado'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => trans("notice.ticket.error", ['action' => 'cadastrar'])
            ];
        }

        return redirect()->back()->with(compact('notice'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function room($id)
    {
        $data = $this->ticketRepository->findForRoom($id);
        $messages = $data->users()->orderBy('pivot_created_at', 'asc')->get();

        return view('modules.ticket.room', compact('data', 'messages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roomPost(TicketRoomRequest $request, $id)
    {
        try {
            $this->runActionOnRoom($request, $id);

            $this->ticketRepository->assign($id, Auth::user()->id, [
                'message' => $request->input('message'),
                'created_at' => \Carbon\Carbon::now()
            ]);

            $notice = [
                'status' => 'success',
                'message' => trans("notice.ticket.success", ['action' => 'enviado'])
            ];
        } catch (\Illuminate\Database\QueryException $exception) {
            $notice = [
                'status' => 'danger',
                'message' => $exception->getMessage()
            ];
        }

        return redirect()->back()->with(compact('notice'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    protected function runActionOnRoom(Request $request, $id)
    {
        $action = $request->input('action');

        if (empty($action)) {
            return false;
        }

        $this->ticketRepository->update($id, ['situation' => $action]);

        $notice = [
            'status' => 'success',
            'message' => trans("notice.ticket.success", ['action' => 'enviado'])
        ];

        return true;
    }
}
