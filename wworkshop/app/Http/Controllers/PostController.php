<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Laravel CRUD",
 *      description="Documentation de l'API CRUD avec Laravel et Swagger"
 * )
 *
 * @OA\PathItem(path="/api")
 */
class PostController extends Controller
{
     /**
     * @OA\Get(
     *     path="api/posts",
     *     summary="Liste des posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des posts",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Post"))
     *     )
     * )
     */
    public function index()
    {
       return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Créer un post",
     *     tags={"Posts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "content"},
     *             @OA\Property(property="title", type="string", example="Mon premier post"),
     *             @OA\Property(property="content", type="string", example="Contenu du post")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Post créé", @OA\JsonContent(ref="#/components/schemas/Post")),
     *     @OA\Response(response=400, description="Données invalides")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     */
     /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Afficher un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Détails du post", @OA\JsonContent(ref="#/components/schemas/Post")),
     *     @OA\Response(response=404, description="Post non trouvé")
     * )
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
     /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Mettre à jour un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "content"},
     *             @OA\Property(property="title", type="string", example="Titre mis à jour"),
     *             @OA\Property(property="content", type="string", example="Contenu mis à jour")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Post mis à jour", @OA\JsonContent(ref="#/components/schemas/Post")),
     *     @OA\Response(response=404, description="Post non trouvé")
     * )
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
     /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Supprimer un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID du post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Post supprimé"),
     *     @OA\Response(response=404, description="Post non trouvé")
     * )
     */
   
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post supprimé']);
    }
}
