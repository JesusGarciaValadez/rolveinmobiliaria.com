<?php

use Faker\Generator as Faker;

$factory->define(App\Sale::class, function (Faker $faker) {
  return [
    'internal_expedients_id' => function () {
      return factory(App\InternalExpedient::class)->create()->id;
    },
    $table->integer('sale_documents_id')
          ->unsigned();
    $table->foreign('sale_documents_id')
          ->references('id')
          ->on('sale_documents')
          ->onUpdate('cascade')
          ->onDelete('cascade');
    $table->integer('sale_closing_contracts_id')
          ->unsigned();
    $table->foreign('sale_closing_contracts_id')
          ->references('id')
          ->on('sale_closing_contracts')
          ->onUpdate('cascade')
          ->onDelete('cascade');
    $table->integer('sale_logs_id')
          ->unsigned();
    $table->foreign('sale_logs_id')
          ->references('id')
          ->on('sale_logs')
          ->onUpdate('cascade')
          ->onDelete('cascade');
    $table->integer('sale_contracts_id')
          ->unsigned();
    $table->foreign('sale_contracts_id')
          ->references('id')
          ->on('sale_contracts')
          ->onUpdate('cascade')
          ->onDelete('cascade');
    $table->integer('sale_notaries_id')
          ->unsigned();
    $table->foreign('sale_notaries_id')
          ->references('id')
          ->on('sale_notaries')
          ->onUpdate('cascade')
          ->onDelete('cascade');
    $table->integer('sale_signatures_id')
          ->unsigned();
    $table->foreign('sale_signatures_id')
          ->references('id')
          ->on('sale_signatures')
          ->onUpdate('cascade')
          ->onDelete('cascade');
  ];
});
