<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\ParserInput;
use App\Entity\Bank;
use App\Service\Parser\AlfaBank\AlfaBankParserStrategy;
use App\Service\Parser\ParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/v1/parser/{bankName}", name="index", methods={"POST"})
 *
 * @param Request $request
 * @param string  $bankName
 *
 * @return void
 */
class Parser extends AbstractController
{
    private AlfaBankParserStrategy $alfaBankParserStrategy;

    private ParserInterface $parser;

    private SerializerInterface $serializer;

    public function __construct(
        ParserInterface $parser,
        SerializerInterface $serializer,
        AlfaBankParserStrategy $alfaBankParserStrategy)
    {
        $this->parser = $parser;
        $this->serializer = $serializer;
        $this->alfaBankParserStrategy = $alfaBankParserStrategy;
    }

    public function __invoke(Request $request, string $bankName): Response
    {
        if (Bank::ALFA_BANK_ALIAS !== $bankName) {
            return new JsonResponse([
                'message' => 'Данный банк не поддерживается.',
            ], Response::HTTP_BAD_REQUEST);
        }

        /** @var ParserInput $parserRequestDto */
        $parserRequestDto = $this->serializer->deserialize(
            $request->getContent(),
            ParserInput::class,
            'json',
        );

        $this->parser
            ->setStrategy($this->alfaBankParserStrategy)
            ->parseReport(
                $parserRequestDto->getFile(),
                $parserRequestDto->getDateFrom(),
                $parserRequestDto->getDateTo()
            );

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
