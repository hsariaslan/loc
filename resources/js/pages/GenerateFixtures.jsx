import React, {useEffect, useState} from 'react';
import { useDispatch, useSelector } from 'react-redux';
import {
    selectFixtures,
    setFixtures, setMatchesOfWeek,
} from "../reducers/rootReducer";
import { FixturesService } from "../services";
import {Link} from "react-router-dom";

const GenerateFixtures = () => {
    const dispatch = useDispatch();
    // const teams = useSelector(selectTeams);
    const fixtures = useSelector(selectFixtures);

    const regenerateFixtures = () => {
        FixturesService.regenerateFixtures().then(data => {
            dispatch(setFixtures(data));
        });
    }

    useEffect(() => {
        FixturesService.generateFixtures().then(data => {
            dispatch(setFixtures(data));
        });
    }, [fixtures.whenToUpdateProp]);

    let i = 0;

    const fixturesList = fixtures.map((weeks) => {
        i ++;

        return (
            <li key={"week-" + i} className="list-group-item text-start">
                <h4>Week {i}</h4>

                {weeks.map((match) => {
                    return (
                        <div key={"match-" + match.id}>
                            {match.home_team?.name + " - " + match.away_team?.name}
                        </div>
                    );
                })}
            </li>
        );
    });

    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>Generated Fixtures</h2></div>
                        <div className="card-body">
                            <ul className="list-group">
                                {fixturesList}
                            </ul>
                            <Link to="/" className="btn btn-danger mt-3">Back</Link>
                            <button className="btn btn-secondary mt-3 mx-3" onClick={() => regenerateFixtures()}>Regenerate Fixtures</button>
                            <Link to="/simulation" className="btn btn-primary mt-3">Start Simulation</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default GenerateFixtures;
