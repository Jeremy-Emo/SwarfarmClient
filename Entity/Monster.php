<?php


namespace SwarfarmClient\Entity;


use SwarfarmClient\Exception\TranslatorException;
use SwarfarmClient\Utils\Translator;

class Monster
{
    const IMAGE_BASE_PATH = "https://swarfarm.com/static/herders/images/monsters/";

    /**
     * Monster constructor.
     * @param array $initialData
     */
    public function __construct(array $initialData)
    {
        foreach ($initialData as $key => $value) {
            if (!is_array($value)) {
                $this->{$key} = $value;
            } else {
                switch ($key) {
                    case 'skills':
                    case 'homunculus_skills':
                        $this->{$key} = $value;
                        break;
                    case 'awaken_cost':
                        foreach ($value as $cost) {
                            $this->addAwakenCost(new ItemsCost($cost));
                        }
                        break;
                    case 'craft_materials':
                        foreach ($value as $cost) {
                            $this->addCraftMaterials(new ItemsCost($cost));
                        }
                        break;
                    case 'source':
                        foreach ($value as $source) {
                            $this->addSource(new Source($source));
                        }
                        break;
                    case 'leader_skill':
                        $this->leader_skill = new LeaderSkill($value);
                        break;
                }
            }
        }
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->name;
    }

    /**
     * @param string $language
     * @return Monster
     * @throws TranslatorException
     */
    public function translateTo(string $language) : Monster
    {
        $translator = new Translator($language);

        $this->name = $translator->translate('monsters', $this->name);
        /** @var $cost ItemsCost */
        foreach ($this->getAwakenCost() as $cost) {
            $cost->translateTo($language);
        }
        /** @var $cost ItemsCost */
        foreach ($this->getCraftMaterials() as $cost) {
            $cost->translateTo($language);
        }
        /** @var $source Source */
        foreach ($this->getSource() as $source) {
            $source->translateTo($language);
        }
        $this->awaken_bonus = $translator->translate('awaken_bonus', $this->awaken_bonus);

        return $this;
    }

    /**
     * @return string
     */
    public function getImagePath() : string
    {
        return self::IMAGE_BASE_PATH . $this->getImageFilename();
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $bestiary_slug;

    /**
     * @var int
     */
    private $com2us_id;

    /**
     * @var int
     */
    private $family_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $image_filename;

    /**
     * @var string
     */
    private $element;

    /**
     * @var string
     */
    private $archetype;

    /**
     * @var int
     */
    private $base_stars;

    /**
     * @var int
     */
    private $natural_stars;

    /**
     * @var bool
     */
    private $obtainable;

    /**
     * @var bool
     */
    private $can_awaken;

    /**
     * @var int
     */
    private $awaken_level;

    /**
     * @var string
     */
    private $awaken_bonus;

    /**
     * @var array
     */
    private $skills;

    /**
     * @var int
     */
    private $skill_ups_to_max;

    /**
     * @var ?LeaderSkill
     */
    private $leader_skill;

    /**
     * @var array
     */
    private $homunculus_skills;

    /**
     * @var int
     */
    private $base_hp;

    /**
     * @var int
     */
    private $base_attack;

    /**
     * @var int
     */
    private $base_defense;

    /**
     * @var int
     */
    private $speed;

    /**
     * @var int
     */
    private $crit_rate;

    /**
     * @var int
     */
    private $crit_damage;

    /**
     * @var int
     */
    private $resistance;

    /**
     * @var int
     */
    private $accuracy;

    /**
     * @var int
     */
    private $raw_hp;

    /**
     * @var int
     */
    private $raw_attack;

    /**
     * @var int
     */
    private $raw_defense;

    /**
     * @var int
     */
    private $max_lvl_hp;

    /**
     * @var int
     */
    private $max_lvl_attack;

    /**
     * @var int
     */
    private $max_lvl_defense;

    /**
     * @var int|null
     */
    private $awakens_from;

    /**
     * @var int|null
     */
    private $awakens_to;

    /**
     * @var array
     */
    private $awaken_cost;

    /**
     * @var array
     */
    private $source;

    /**
     * @var bool
     */
    private $fusion_food;

    /**
     * @var bool
     */
    private $homunculus;

    /**
     * @var int
     */
    private $craft_cost;

    /**
     * @var array
     */
    private $craft_materials;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Monster
     */
    public function setId(int $id): Monster
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Monster
     */
    public function setUrl(string $url): Monster
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getBestiarySlug(): string
    {
        return $this->bestiary_slug;
    }

    /**
     * @param string $bestiary_slug
     * @return Monster
     */
    public function setBestiarySlug(string $bestiary_slug): Monster
    {
        $this->bestiary_slug = $bestiary_slug;
        return $this;
    }

    /**
     * @return int
     */
    public function getCom2usId(): int
    {
        return $this->com2us_id;
    }

    /**
     * @param int $com2us_id
     * @return Monster
     */
    public function setCom2usId(int $com2us_id): Monster
    {
        $this->com2us_id = $com2us_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getFamilyId(): int
    {
        return $this->family_id;
    }

    /**
     * @param int $family_id
     * @return Monster
     */
    public function setFamilyId(int $family_id): Monster
    {
        $this->family_id = $family_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Monster
     */
    public function setName(string $name): Monster
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageFilename(): string
    {
        return $this->image_filename;
    }

    /**
     * @param string $image_filename
     * @return Monster
     */
    public function setImageFilename(string $image_filename): Monster
    {
        $this->image_filename = $image_filename;
        return $this;
    }

    /**
     * @return string
     */
    public function getElement(): string
    {
        return $this->element;
    }

    /**
     * @param string $element
     * @return Monster
     */
    public function setElement(string $element): Monster
    {
        $this->element = $element;
        return $this;
    }

    /**
     * @return string
     */
    public function getArchetype(): string
    {
        return $this->archetype;
    }

    /**
     * @param string $archetype
     * @return Monster
     */
    public function setArchetype(string $archetype): Monster
    {
        $this->archetype = $archetype;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseStars(): int
    {
        return $this->base_stars;
    }

    /**
     * @param int $base_stars
     * @return Monster
     */
    public function setBaseStars(int $base_stars): Monster
    {
        $this->base_stars = $base_stars;
        return $this;
    }

    /**
     * @return int
     */
    public function getNaturalStars(): int
    {
        return $this->natural_stars;
    }

    /**
     * @param int $natural_stars
     * @return Monster
     */
    public function setNaturalStars(int $natural_stars): Monster
    {
        $this->natural_stars = $natural_stars;
        return $this;
    }

    /**
     * @return bool
     */
    public function isObtainable(): bool
    {
        return $this->obtainable;
    }

    /**
     * @param bool $obtainable
     * @return Monster
     */
    public function setObtainable(bool $obtainable): Monster
    {
        $this->obtainable = $obtainable;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCanAwaken(): bool
    {
        return $this->can_awaken;
    }

    /**
     * @param bool $can_awaken
     * @return Monster
     */
    public function setCanAwaken(bool $can_awaken): Monster
    {
        $this->can_awaken = $can_awaken;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwakenLevel(): int
    {
        return $this->awaken_level;
    }

    /**
     * @param int $awaken_level
     * @return Monster
     */
    public function setAwakenLevel(int $awaken_level): Monster
    {
        $this->awaken_level = $awaken_level;
        return $this;
    }

    /**
     * @return string
     */
    public function getAwakenBonus(): string
    {
        return $this->awaken_bonus;
    }

    /**
     * @param string $awaken_bonus
     * @return Monster
     */
    public function setAwakenBonus(string $awaken_bonus): Monster
    {
        $this->awaken_bonus = $awaken_bonus;
        return $this;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @param array $skills
     * @return Monster
     */
    public function setSkills(array $skills): Monster
    {
        $this->skills = $skills;
        return $this;
    }

    /**
     * @return int
     */
    public function getSkillUpsToMax(): int
    {
        return $this->skill_ups_to_max;
    }

    /**
     * @param int $skill_ups_to_max
     * @return Monster
     */
    public function setSkillUpsToMax(int $skill_ups_to_max): Monster
    {
        $this->skill_ups_to_max = $skill_ups_to_max;
        return $this;
    }

    /**
     * @return LeaderSkill|null
     */
    public function getLeaderSkill(): ?LeaderSkill
    {
        return $this->leader_skill;
    }

    /**
     * @param LeaderSkill|null $leader_skill
     * @return Monster
     */
    public function setLeaderSkill(?LeaderSkill $leader_skill): Monster
    {
        $this->leader_skill = $leader_skill;
        return $this;
    }

    /**
     * @return array
     */
    public function getHomunculusSkills(): array
    {
        return $this->homunculus_skills;
    }

    /**
     * @param array $homunculus_skills
     * @return Monster
     */
    public function setHomunculusSkills(array $homunculus_skills): Monster
    {
        $this->homunculus_skills = $homunculus_skills;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseHp(): int
    {
        return $this->base_hp;
    }

    /**
     * @param int $base_hp
     * @return Monster
     */
    public function setBaseHp(int $base_hp): Monster
    {
        $this->base_hp = $base_hp;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseAttack(): int
    {
        return $this->base_attack;
    }

    /**
     * @param int $base_attack
     * @return Monster
     */
    public function setBaseAttack(int $base_attack): Monster
    {
        $this->base_attack = $base_attack;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaseDefense(): int
    {
        return $this->base_defense;
    }

    /**
     * @param int $base_defense
     * @return Monster
     */
    public function setBaseDefense(int $base_defense): Monster
    {
        $this->base_defense = $base_defense;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Monster
     */
    public function setSpeed(int $speed): Monster
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return int
     */
    public function getCritRate(): int
    {
        return $this->crit_rate;
    }

    /**
     * @param int $crit_rate
     * @return Monster
     */
    public function setCritRate(int $crit_rate): Monster
    {
        $this->crit_rate = $crit_rate;
        return $this;
    }

    /**
     * @return int
     */
    public function getCritDamage(): int
    {
        return $this->crit_damage;
    }

    /**
     * @param int $crit_damage
     * @return Monster
     */
    public function setCritDamage(int $crit_damage): Monster
    {
        $this->crit_damage = $crit_damage;
        return $this;
    }

    /**
     * @return int
     */
    public function getResistance(): int
    {
        return $this->resistance;
    }

    /**
     * @param int $resistance
     * @return Monster
     */
    public function setResistance(int $resistance): Monster
    {
        $this->resistance = $resistance;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccuracy(): int
    {
        return $this->accuracy;
    }

    /**
     * @param int $accuracy
     * @return Monster
     */
    public function setAccuracy(int $accuracy): Monster
    {
        $this->accuracy = $accuracy;
        return $this;
    }

    /**
     * @return int
     */
    public function getRawHp(): int
    {
        return $this->raw_hp;
    }

    /**
     * @param int $raw_hp
     * @return Monster
     */
    public function setRawHp(int $raw_hp): Monster
    {
        $this->raw_hp = $raw_hp;
        return $this;
    }

    /**
     * @return int
     */
    public function getRawAttack(): int
    {
        return $this->raw_attack;
    }

    /**
     * @param int $raw_attack
     * @return Monster
     */
    public function setRawAttack(int $raw_attack): Monster
    {
        $this->raw_attack = $raw_attack;
        return $this;
    }

    /**
     * @return int
     */
    public function getRawDefense(): int
    {
        return $this->raw_defense;
    }

    /**
     * @param int $raw_defense
     * @return Monster
     */
    public function setRawDefense(int $raw_defense): Monster
    {
        $this->raw_defense = $raw_defense;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLvlHp(): int
    {
        return $this->max_lvl_hp;
    }

    /**
     * @param int $max_lvl_hp
     * @return Monster
     */
    public function setMaxLvlHp(int $max_lvl_hp): Monster
    {
        $this->max_lvl_hp = $max_lvl_hp;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLvlAttack(): int
    {
        return $this->max_lvl_attack;
    }

    /**
     * @param int $max_lvl_attack
     * @return Monster
     */
    public function setMaxLvlAttack(int $max_lvl_attack): Monster
    {
        $this->max_lvl_attack = $max_lvl_attack;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxLvlDefense(): int
    {
        return $this->max_lvl_defense;
    }

    /**
     * @param int $max_lvl_defense
     * @return Monster
     */
    public function setMaxLvlDefense(int $max_lvl_defense): Monster
    {
        $this->max_lvl_defense = $max_lvl_defense;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAwakensFrom(): ?int
    {
        return $this->awakens_from;
    }

    /**
     * @param int|null $awakens_from
     * @return Monster
     */
    public function setAwakensFrom(?int $awakens_from): Monster
    {
        $this->awakens_from = $awakens_from;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAwakensTo(): ?int
    {
        return $this->awakens_to;
    }

    /**
     * @param int|null $awakens_to
     * @return Monster
     */
    public function setAwakensTo(?int $awakens_to): Monster
    {
        $this->awakens_to = $awakens_to;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getAwakenCost(): ?array
    {
        return $this->awaken_cost;
    }

    /**
     * @param array|null $awaken_cost
     * @return Monster
     */
    public function setAwakenCost(?array $awaken_cost): Monster
    {
        $this->awaken_cost = $awaken_cost;
        return $this;
    }

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @param array $source
     * @return Monster
     */
    public function setSource(array $source): Monster
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFusionFood(): bool
    {
        return $this->fusion_food;
    }

    /**
     * @param bool $fusion_food
     * @return Monster
     */
    public function setFusionFood(bool $fusion_food): Monster
    {
        $this->fusion_food = $fusion_food;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHomunculus(): bool
    {
        return $this->homunculus;
    }

    /**
     * @param bool $homunculus
     * @return Monster
     */
    public function setHomunculus(bool $homunculus): Monster
    {
        $this->homunculus = $homunculus;
        return $this;
    }

    /**
     * @return int
     */
    public function getCraftCost(): int
    {
        return $this->craft_cost;
    }

    /**
     * @param int $craft_cost
     * @return Monster
     */
    public function setCraftCost(int $craft_cost): Monster
    {
        $this->craft_cost = $craft_cost;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getCraftMaterials(): ?array
    {
        return $this->craft_materials;
    }

    /**
     * @param array|null $craft_materials
     * @return Monster
     */
    public function setCraftMaterials(?array $craft_materials): Monster
    {
        $this->craft_materials = $craft_materials;
        return $this;
    }

    /**
     * @param Source $source
     * @return Monster
     */
    public function addSource(Source $source) : Monster
    {
        $this->source[] = $source;
        return $this;
    }

    /**
     * @param ItemsCost $awakenCost
     * @return Monster
     */
    public function addAwakenCost(ItemsCost $awakenCost) : Monster
    {
        $this->awaken_cost[] = $awakenCost;

        return $this;
    }

    /**
     * @param ItemsCost $craftMaterials
     * @return Monster
     */
    public function addCraftMaterials(ItemsCost $craftMaterials) : Monster
    {
        $this->craft_materials[] = $craftMaterials;

        return $this;
    }
}