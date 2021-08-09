<?php

declare(strict_types=1);

namespace App\UseCase\Article\Interactors;

use App\Domain\Article\Criterion\ArticleCriteria;
use App\Domain\Article\Entities\Article;
use App\Domain\Article\Repositories\ArticleRepository;
use App\Domain\Article\ValueObjects\ArticleContent;
use App\Domain\Article\ValueObjects\ArticleId;
use App\Domain\Article\ValueObjects\ArticleTitle;
use App\Domain\Article\ValueObjects\ArticleType;
use App\UseCase\Article\Inputs\ArticleCreateInput;
use App\UseCase\Article\Inputs\ArticleGetInput;
use App\UseCase\Article\Inputs\ArticleUpdateInput;
use App\UseCase\Interactor;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;

/**
 * 記事ユースケースクラス
 */
final class ArticleInteractor extends Interactor
{
    /**
     * リポジトリクラス
     *
     * @var ArticleRepository
     */
    private ArticleRepository $articleRepository;

    /**
     * コンストラクタインジェクション
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param ArticleId $id
     * @return Article
     */
    public function getArticle(ArticleId $id): Article
    {
        return $this->articleRepository
            ->findById($id);
    }

    /**
     * @param ArticleGetInput $input
     * @return array
     */
    public function getArticles(ArticleGetInput $input): array
    {
        $criteria = new ArticleCriteria($input->order, $input->limit);

        return $this->articleRepository
            ->findAllByCriteria($criteria);
    }

    /**
     * @param ArticleCreateInput $input
     * @throws InvalidEnumMemberException
     */
    public function createArticle(ArticleCreateInput $input)
    {
        $article = new Article(
            null,
            new ArticleTitle($input->title),
            new ArticleType($input->type),
            new ArticleContent($input->content)
        );

        $this->articleRepository->create($article);
    }

    /**
     * @param ArticleUpdateInput $input
     * @param ArticleId          $id
     * @throws InvalidEnumMemberException
     */
    public function updateArticle(ArticleUpdateInput $input, ArticleId $id)
    {
        $article = new Article(
            $id,
            new ArticleTitle($input->title),
            new ArticleType($input->type),
            new ArticleContent($input->content)
        );

        $this->articleRepository
            ->update($article);
    }

    /**
     * @param ArticleId $id
     */
    public function deleteArticle(ArticleId $id)
    {
        $article = $this->articleRepository
            ->findById($id);

        $this->articleRepository
            ->delete($article);
    }
}
