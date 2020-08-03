SELECT a.presenter_name, SUM(a.rec_tot) AS total
FROM
(SELECT
    presenter.presenter_name AS presenter_name,
    (visual + clarity + thoroughness
     + breadth + depth + quality
     + discussion + understanding + overall)
    AS rec_tot
    FROM scores
    INNER JOIN judge ON judge.judge_id = scores.judge_ID
    INNER JOIN poster ON poster.poster_ID = scores.poster_ID
    INNER JOIN owns ON poster.poster_ID = owns.poster_ID
    INNER JOIN presenter ON presenter.presenter_ID = owns.presenter_ID
    ORDER BY presenter.academic_level, presenter.area_of_study, presenter.category
) AS a
GROUP BY a.presenter_name
;