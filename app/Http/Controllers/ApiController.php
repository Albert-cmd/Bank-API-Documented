<?php
namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Compte;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
/**
 *  * @OA\Get(
 *     path="/",
 *     tags={"Inici"},
 *     description="Pagina d'inici",
 *     @OA\Response(response="default", description="Welcome page")
 * )
 *
 * @OA\Server(
 *     url="http://localhost/M7/pt2a/pt1a/public/index.php/api",
 *     description="L5 Swagger OpenApi Server"
 * )
 * @OA\Info(
version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="Api Compte/Clients",
 *      description="Una api de comptes i clients implementat en laravel amb un servidor mysql.",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 *     );
**/
class ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // COMPTES.
    /**
     * @OA\Get(
     *      path="/comptes",
     *      tags={"Comptes"},
     *      summary="Veure tots els comptes.",
     *      @OA\Response(
     *          response=200,
     *          description="Retorna tots els comptes."
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    function getComptes () {
        return Compte::all();
    }

    /**

    /**
     * @OA\Get(
     *      path="/compteById/{id}",
     *      operationId="compteById",
     *      tags={"Comptes"},
     *      summary="Retorna un compte donada una id de compte.",
     *      description="Retorna un compte donada una id de compte.",
     *     @OA\Parameter(
     *          name="id",
     *          description="Compte id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Retorna tots els comptes."),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    function compteById($id){
        return Compte::find($id);
    }

    /**
     * @OA\Put(
     *      path="/compte/{id}",
     *      operationId="updateCompte",
     *      tags={"Comptes"},
     *      summary="Actualitza un compte",
     *      description="Acutasliztza un compte existent",
     *        @OA\Parameter(
     *          name="id",
     *          description="Compte id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(),
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *      @OA\Schema(
     *               type="object",
     *               @OA\Property(property="saldo", type="int"),
     *               @OA\Property(property="codi", type="int"),
     *               @OA\Property(property="client_id", type="int")
     *
     *            )
     *      )
     *   ),
     *     @OA\Response(response=201,description="S'ha creat el compte."),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     *
     * )
     */

    function updateCompte (Request $request, $id) {

        //cal posar en la peticio PUT el Header field:
        //Content-Type = application/x-www-form-urlencoded
        $compte = Compte::find($id);
        $compte->update($request->all());

        return $compte;
    }

    /**
 * @OA\Post(
 *      path="/addCompte",
 *      operationId="postCompte",
 *      tags={"Comptes"},
 *      summary="Afegeix un compte",
 *      description="Afegeix un compte",
 *      @OA\RequestBody(
 *         @OA\JsonContent(),
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *      @OA\Schema(
     *               type="object",
     *               required={"saldo","codi", "client_id"},
     *               @OA\Property(property="saldo", type="int"),
     *               @OA\Property(property="codi", type="int"),
     *               @OA\Property(property="client_id", type="int")
     *
     *            )
     *      )
     *   ),
     *     @OA\Response(response=201,description="S'ha creat el compte."),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
 *
 * )
 */
    function postCompte(Request $request){

        $compte = Compte::create($request->all());
        $compte->save();
        return $compte;

    }

    /**
     * @OA\Delete(
     *      path="/compte/delete/{id}",
     *      operationId="deleteCompte",
     *      tags={"Comptes"},
     *      summary="Elimina un compte donada  una id de compte.",
     *      description="Elimina un compte donada una id de compte.",
     *     @OA\Parameter(
     *          name="id",
     *          description="Compte id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Retorna tots els comptes."),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    function deleteCompte($id){

        $compte = Compte::find($id);
        $compte->delete();
        return $compte;
    }



    /**
     * @OA\Get(
     *      path="/clients",
     *      tags={"Clients"},
     *      summary="Retorna tots els clients.",
     *      @OA\Response(
     *          response=200,
     *          description="Retorna tots els clients."
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

   // CLIENTS.
    function getClients () {
        return Client::all();
    }

    /**
     * @OA\Get(
     *      path="/clientById/{id}",
     *      operationId="clientById",
     *      tags={"Clients"},
     *      summary="Retorna un client  donada una id de client.",
     *      description="Retorna un client donada una id de client.",
     *     @OA\Parameter(
     *          name="id",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Retorna tots els comptes."),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    function clientByid($id){
        return Client::find($id);
    }

    /**
     * @OA\Put(
     *      path="/client/{id}",
     *      operationId="updateClient",
     *      tags={"Clients"},
     *      summary="Actualitza un client",
     *      description="Acutasliztza un client existent",
     *        @OA\Parameter(
     *          name="id",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *         @OA\JsonContent(),
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *      @OA\Schema(
     *               type="object",
     *               @OA\Property(property="dni", type="text"),
     *               @OA\Property(property="nom", type="text"),
     *               @OA\Property(property="cognoms", type="text"),
     *               @OA\Property(property="dataN", type="date")
     *
     *            )
     *      )
     *   ),
     *     @OA\Response(response=201,description="S'ha creat el compte."),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     *
     * )
     */
    function updateClient (Request $request, $id) {
        //cal posar en la peticio PUT el Header field:
        //Content-Type = application/x-www-form-urlencoded
        $client = Client::find($id);
        $client->update($request->all());

        return $client;
    }


    /**
     * @OA\Post(
     *      path="/addClient",
     *      operationId="postClient",
     *      tags={"Clients"},
     *      summary="Afegeix un client",
     *      description="Afegeix un client",
     *      @OA\RequestBody(
     *         @OA\JsonContent(),
     *     @OA\MediaType(
     *         mediaType="multipart/form-data",
     *      @OA\Schema(
     *               type="object",
     *               required={"dni","nom", "cognoms"},
     *              @OA\Property(property="dni", type="text"),
     *               @OA\Property(property="nom", type="text"),
     *               @OA\Property(property="cognoms", type="text"),
     *               @OA\Property(property="dataN", type="date")
     *
     *            )
     *      )
     *   ),
     *     @OA\Response(response=201,description="S'ha creat el compte."),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     *
     * )
     */

    function postClient(Request $request){
        $client = Client::create($request->all());
        $client->save();
        return $client;
    }

    /**
     * @OA\Delete(
     *      path="/client/delete/{id}",
     *      operationId="deleteClient",
     *      tags={"Clients"},
     *      summary="Elimina un client donada  una id de client.",
     *      description="Elimina un client donada una id de client.",
     *     @OA\Parameter(
     *          name="id",
     *          description="Client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Retorna tots els comptes."),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    function deleteClient($id){
        $client = Client::find($id);
        $client->delete();
        return $client;
    }

}


