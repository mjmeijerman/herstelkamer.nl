<?php

namespace App\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class BookedDays
 * @package App\Entity
 */
final class BookedDayRepository extends EntityRepository
{
    /**
     * @param \DateTimeImmutable $beginningOfTheMonth
     * @param \DateTimeImmutable $endOfTheMonth
     *
     * @return array
     */
    public function findAllForMonth(
        \DateTimeImmutable $beginningOfTheMonth,
        \DateTimeImmutable $endOfTheMonth
    ): array {
        $connection = $this->getEntityManager()->getConnection();

        $sql = <<<EOQ
SELECT
  *
FROM
  booked_days
WHERE
  date >= :beginningOfTheMonth
AND 
  date <= :endOfTheMonth
ORDER BY date ASC
EOQ;

        $stmt = $connection->executeQuery(
            $sql,
            [
                'beginningOfTheMonth' => $beginningOfTheMonth->format('Y-m-d 00:00:00'),
                'endOfTheMonth'       => $endOfTheMonth->format('Y-m-d 23:59:59'),
            ]
        );

        $bookedDays = [];
        while (($row = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $dateTime = new \DateTimeImmutable($row['date']);
            $status   = BookedDayStatus::fromString($row['status']);

            $bookedDays[$dateTime->format('j')] = $status->toString();
        }

        return $bookedDays;
    }
}
