<?php
use App\Model\postModel;

$app->group('/post/', function () {

    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hello Users');
    });


    $this->get('countByUser', function ($req, $res, $args) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->countPostByUser()->result
            )
        );
    });


    $this->get('countByDate', function ($req, $res, $args) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->countPostByDate()->result
            )
        );
    });




    $this->get('getAll', function ($req, $res, $args) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()->result
            )
        );
    });

    $this->get('get/{id}', function ($req, $res, $args) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    $this->post('save', function ($req, $res) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->InsertOrUpdate(
                    $req->getParsedBody()
                )
            )
        );
    });

    $this->post('delete/{id}', function ($req, $res, $args) {
        $um = new postModel();

        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Delete($args['id'])
            )
        );
    });

});
