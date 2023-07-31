<?php

declare(strict_types=1);

namespace app\Module\Embedding\Model\Redis;

use app\Module\Config\Annotation\ConfigModel;
use app\Module\Config\Model\Redis\Traits\TConfigModel;
use app\Module\OpenAI\Model\Redis\ModelConfig;
use Imi\Model\Annotation\Column;
use Imi\Model\Annotation\Entity;
use Imi\Model\Annotation\JsonDecode;
use Imi\Model\Annotation\RedisEntity;
use Imi\Model\RedisModel;
use Imi\Util\Imi;

#[
    Entity(),
    RedisEntity(key: 'config:embedding', storage: 'hash_object'),
    ConfigModel(title: '模型训练设置'),
]
class EmbeddingConfig extends RedisModel
{
    use TConfigModel;

    /**
     * 压缩文件最大尺寸.
     */
    #[Column]
    protected int $maxCompressedFileSize = 4 * 1024 * 1024;

    public function getMaxCompressedFileSize(): int
    {
        return $this->maxCompressedFileSize;
    }

    public function setMaxCompressedFileSize(int $maxCompressedFileSize): self
    {
        $this->maxCompressedFileSize = $maxCompressedFileSize;

        return $this;
    }

    #[Column]
    protected ?string $maxCompressedFileSizeText = null;

    public function getMaxCompressedFileSizeText(): ?string
    {
        return Imi::formatByte($this->maxCompressedFileSize);
    }

    /**
     * 单个文件最大尺寸.
     */
    #[Column]
    protected int $maxSingleFileSize = 2 * 1024 * 1024;

    public function getMaxSingleFileSize(): int
    {
        return $this->maxSingleFileSize;
    }

    public function setMaxSingleFileSize(int $maxSingleFileSize): self
    {
        $this->maxSingleFileSize = $maxSingleFileSize;

        return $this;
    }

    #[Column]
    protected ?string $maxSingleFileSizeText = null;

    public function getMaxSingleFileSizeText(): ?string
    {
        return Imi::formatByte($this->maxSingleFileSize);
    }

    /**
     * 所有文件最大尺寸.
     */
    #[Column]
    protected int $maxTotalFilesSize = 4 * 1024 * 1024;

    public function getMaxTotalFilesSize(): int
    {
        return $this->maxTotalFilesSize;
    }

    public function setMaxTotalFilesSize(int $maxTotalFilesSize): self
    {
        $this->maxTotalFilesSize = $maxTotalFilesSize;

        return $this;
    }

    #[Column]
    protected ?string $maxTotalFilesSizeText = null;

    public function getMaxTotalFilesSizeText(): ?string
    {
        return Imi::formatByte($this->maxTotalFilesSize);
    }

    /**
     * 段落最大Token数量.
     */
    #[Column]
    protected int $maxSectionTokens = 512;

    public function getMaxSectionTokens(): int
    {
        return $this->maxSectionTokens;
    }

    public function setMaxSectionTokens(int $maxSectionTokens): self
    {
        $this->maxSectionTokens = $maxSectionTokens;

        return $this;
    }

    /**
     * 聊天最多携带段落数量.
     */
    #[Column]
    protected int $chatStreamSections = 5;

    public function getChatStreamSections(): int
    {
        return $this->chatStreamSections;
    }

    public function setChatStreamSections(int $chatStreamSections): self
    {
        $this->chatStreamSections = $chatStreamSections;

        return $this;
    }

    /**
     * 训练模型配置.
     *
     * @var ModelConfig[]
     */
    #[
        Column(type: 'json'),
        JsonDecode(wrap: ModelConfig::class, arrayWrap: true),
    ]
    protected ?array $embeddingModelConfig = null;

    /**
     * @return ModelConfig[]
     */
    public function getEmbeddingModelConfig(): array
    {
        if (null === $this->embeddingModelConfig)
        {
            return $this->embeddingModelConfig = [
                'text-embedding-ada-002' => new ModelConfig(['inputTokenMultiple' => '0.05', 'outputTokenMultiple' => '0.05']),
            ];
        }

        return $this->embeddingModelConfig;
    }

    /**
     * @param ModelConfig[] $embeddingModelConfig
     */
    public function setEmbeddingModelConfig(array $embeddingModelConfig): self
    {
        $this->embeddingModelConfig = $embeddingModelConfig;

        return $this;
    }

    /**
     * 聊天模型定价.
     *
     * @var ModelConfig[]
     */
    #[
        Column(type: 'json'),
        JsonDecode(wrap: ModelConfig::class, arrayWrap: true),
    ]
    protected ?array $chatModelConfig = null;

    /**
     * @return ModelConfig[]
     */
    public function getChatModelConfig(): ?array
    {
        if (null === $this->chatModelConfig)
        {
            return $this->chatModelConfig = [
                'gpt-3.5-turbo'     => new ModelConfig(['inputTokenMultiple' => '0.75', 'outputTokenMultiple' => '1.0']),
                'gpt-3.5-turbo-16k' => new ModelConfig(['inputTokenMultiple' => '1.5', 'outputTokenMultiple' => '2.0']),
                'gpt-4'             => new ModelConfig(['enable' => false, 'inputTokenMultiple' => '150', 'outputTokenMultiple' => '3.0']),
                'gpt-4-32k'         => new ModelConfig(['enable' => false, 'inputTokenMultiple' => '300', 'outputTokenMultiple' => '6.0']),
            ];
        }

        return $this->chatModelConfig;
    }

    /**
     * @param ModelConfig[] $chatModelConfig
     */
    public function setChatModelConfig(?array $chatModelConfig): self
    {
        $this->chatModelConfig = $chatModelConfig;

        return $this;
    }

    /**
     * 对话限流单位.
     *
     * 支持：microsecond、millisecond、second、minute、hour、day、week、month、year
     */
    #[Column]
    protected string $chatRateLimitUnit = 'second';

    public function getChatRateLimitUnit(): string
    {
        return $this->chatRateLimitUnit;
    }

    public function setChatRateLimitUnit(string $chatRateLimitUnit): self
    {
        $this->chatRateLimitUnit = $chatRateLimitUnit;

        return $this;
    }
    /**
     * 对话限流数量.
     */
    #[Column]
    protected int $chatRateLimitAmount = 1;

    public function getChatRateLimitAmount(): int
    {
        return $this->chatRateLimitAmount;
    }

    public function setChatRateLimitAmount(int $chatRateLimitAmount): self
    {
        $this->chatRateLimitAmount = $chatRateLimitAmount;

        return $this;
    }
}
